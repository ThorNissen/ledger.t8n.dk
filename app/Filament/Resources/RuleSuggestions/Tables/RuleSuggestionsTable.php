<?php

namespace App\Filament\Resources\RuleSuggestions\Tables;

use App\Models\Rule;
use App\Models\RuleSuggestion;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RuleSuggestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('occurrences', 'desc')
            ->columns([
                TextColumn::make('pattern')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('occurrences')
                    ->sortable(),

                TextColumn::make('suggestedTransactionType.name')
                    ->label('Suggested Type')
                    ->placeholder('—'),

                IconColumn::make('is_reviewed')
                    ->boolean()
                    ->label('Reviewed'),

                IconColumn::make('is_accepted')
                    ->boolean()
                    ->label('Accepted'),
            ])
            ->filters([
                Filter::make('pending')
                    ->label('Pending review')
                    ->default()
                    ->query(fn (Builder $query) => $query->where('is_reviewed', false)),
            ])
            ->recordActions([
                Action::make('accept')
                    ->label('Accept')
                    ->icon(Heroicon::OutlinedCheck)
                    ->color('success')
                    ->hidden(fn (RuleSuggestion $record) => $record->is_reviewed)
                    ->fillForm(fn (RuleSuggestion $record) => [
                        'keyword' => $record->pattern,
                        'transaction_type_id' => $record->suggested_transaction_type_id,
                    ])
                    ->schema([
                        TextInput::make('keyword')
                            ->required()
                            ->helperText('The keyword to match against transaction descriptions.'),

                        Select::make('transaction_type_id')
                            ->label('Transaction type')
                            ->relationship('suggestedTransactionType', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->action(function (array $data, RuleSuggestion $record) {
                        Rule::create([
                            'user_id' => $record->user_id,
                            'transaction_type_id' => $data['transaction_type_id'],
                            'keyword' => $data['keyword'],
                            'priority' => 100,
                            'case_sensitive' => false,
                            'is_enabled' => true,
                        ]);

                        $record->update([
                            'is_reviewed' => true,
                            'is_accepted' => true,
                            'suggested_transaction_type_id' => $data['transaction_type_id'],
                        ]);

                        Notification::make()
                            ->title('Rule created')
                            ->body("Keyword \"{$data['keyword']}\" will now be categorized automatically.")
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Reject')
                    ->icon(Heroicon::OutlinedXMark)
                    ->color('danger')
                    ->hidden(fn (RuleSuggestion $record) => $record->is_reviewed)
                    ->requiresConfirmation()
                    ->action(function (RuleSuggestion $record) {
                        $record->update(['is_reviewed' => true, 'is_accepted' => false]);
                    }),

                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('bulk_accept')
                        ->label('Accept selected')
                        ->icon(Heroicon::OutlinedCheck)
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalDescription('A rule will be created for each selected suggestion using the suggested transaction type. Suggestions without a suggested type will be skipped.')
                        ->action(function (Collection $records) {
                            $created = 0;
                            $skipped = 0;

                            foreach ($records as $record) {
                                if ($record->is_reviewed || ! $record->suggested_transaction_type_id) {
                                    $skipped++;

                                    continue;
                                }

                                Rule::create([
                                    'user_id' => $record->user_id,
                                    'transaction_type_id' => $record->suggested_transaction_type_id,
                                    'keyword' => $record->pattern,
                                    'priority' => 100,
                                    'case_sensitive' => false,
                                    'is_enabled' => true,
                                ]);

                                $record->update(['is_reviewed' => true, 'is_accepted' => true]);
                                $created++;
                            }

                            Notification::make()
                                ->title("{$created} rule(s) created".($skipped ? ", {$skipped} skipped" : ''))
                                ->success()
                                ->send();
                        }),

                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
