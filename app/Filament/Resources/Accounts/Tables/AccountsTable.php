<?php

namespace App\Filament\Resources\Accounts\Tables;

use App\Enums\AccountTypeEnum;
use App\Jobs\ProcessImportJob;
use App\Models\Account;
use App\Support\CsvHelper;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('bank_name')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('type')
                    ->badge()
                    ->sortable(),

                TextColumn::make('currency')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label(__('filament.accounts.is_active')),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(AccountTypeEnum::class),
            ])
            ->recordActions([
                Action::make('importCsv')
                    ->label(__('filament.accounts.import_csv'))
                    ->icon(Heroicon::OutlinedArrowUpTray)
                    ->steps([
                        Step::make('Upload')
                            ->description(__('filament.accounts.step_upload_description'))
                            ->schema([
                                FileUpload::make('file')
                                    ->label(__('filament.accounts.field_csv_file'))
                                    ->disk('local')
                                    ->directory('imports')
                                    ->acceptedFileTypes(['text/csv', 'text/plain', 'application/csv'])
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set, mixed $state) {
                                        $set('csv_columns', self::resolveColumns($state));
                                    }),
                            ]),

                        Step::make('Map Columns')
                            ->description(__('filament.accounts.step_map_description'))
                            ->schema([
                                Select::make('date_column')
                                    ->label(__('filament.accounts.field_date_column'))
                                    ->options(fn (Get $get) => self::columnsAsOptions($get('csv_columns')))
                                    ->required(),

                                Select::make('description_column')
                                    ->label(__('filament.accounts.field_description_column'))
                                    ->options(fn (Get $get) => self::columnsAsOptions($get('csv_columns')))
                                    ->required(),

                                Select::make('amount_column')
                                    ->label(__('filament.accounts.field_amount_column'))
                                    ->options(fn (Get $get) => self::columnsAsOptions($get('csv_columns')))
                                    ->required(),

                                Select::make('external_id_column')
                                    ->label(__('filament.accounts.field_external_id_column'))
                                    ->options(fn (Get $get) => self::columnsAsOptions($get('csv_columns')))
                                    ->placeholder(__('filament.accounts.placeholder_skip'))
                                    ->nullable(),
                            ]),
                    ])
                    ->action(function (array $data, Account $record): void {
                        $file = $data['file'];
                        $filePath = $file instanceof TemporaryUploadedFile
                            ? $file->getRealPath()
                            : Storage::disk('local')->path(is_array($file) ? reset($file) : $file);

                        ProcessImportJob::dispatch($filePath, $record->id, [
                            'date' => $data['date_column'],
                            'description' => $data['description_column'],
                            'amount' => $data['amount_column'],
                            'external_id' => $data['external_id_column'] ?? null,
                        ]);
                    })
                    ->successNotificationTitle(__('filament.accounts.import_queued')),

                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    /** @return array<int, string> */
    private static function resolveColumns(mixed $state): array
    {
        $file = is_array($state) ? reset($state) : $state;

        if (empty($file)) {
            return [];
        }

        if ($file instanceof TemporaryUploadedFile) {
            $path = $file->getRealPath();
        } else {
            $path = Storage::disk('local')->path((string) $file);
        }

        if (! $path || ! file_exists($path)) {
            return [];
        }

        return array_keys(CsvHelper::headers($path));
    }

    /** @return array<string, string> */
    private static function columnsAsOptions(mixed $columns): array
    {
        if (empty($columns) || ! is_array($columns)) {
            return [];
        }

        return array_combine($columns, $columns);
    }
}
