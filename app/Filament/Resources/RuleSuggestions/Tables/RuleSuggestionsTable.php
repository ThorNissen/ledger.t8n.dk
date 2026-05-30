<?php

namespace App\Filament\Resources\RuleSuggestions\Tables;

use App\Models\Rule;
use App\Models\RuleSuggestion;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
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
                    ->label(__('filament.rule_suggestions.column_suggested_type'))
                    ->placeholder('—'),
            ])
            ->filters([
                Filter::make('pending')
                    ->label(__('filament.rule_suggestions.filter_pending'))
                    ->default()
                    ->query(fn (Builder $query) => $query->where('is_reviewed', false)),
            ])
            ->recordActions([
                Action::make('accept')
                    ->label(__('filament.rule_suggestions.action_accept'))
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
                            ->helperText(__('filament.rule_suggestions.field_keyword_helper')),

                        Select::make('transaction_type_id')
                            ->label(__('filament.rule_suggestions.field_transaction_type'))
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
                            ->title(__('filament.rule_suggestions.notification_rule_created_title'))
                            ->body(__('filament.rule_suggestions.notification_rule_created_body', ['keyword' => $data['keyword']]))
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label(__('filament.rule_suggestions.action_reject'))
                    ->icon(Heroicon::OutlinedXMark)
                    ->color('danger')
                    ->hidden(fn (RuleSuggestion $record) => $record->is_reviewed)
                    ->requiresConfirmation()
                    ->action(function (RuleSuggestion $record) {
                        $record->update(['is_reviewed' => true, 'is_accepted' => false]);
                    }),

                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('bulk_accept')
                        ->label(__('filament.rule_suggestions.action_bulk_accept'))
                        ->icon(Heroicon::OutlinedCheck)
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalDescription(__('filament.rule_suggestions.bulk_accept_description'))
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
                                ->title(trans_choice('filament.rule_suggestions.notification_bulk_created', $created, ['count' => $created]).($skipped ? __('filament.rule_suggestions.notification_bulk_skipped', ['count' => $skipped]) : ''))
                                ->success()
                                ->send();
                        }),

                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
