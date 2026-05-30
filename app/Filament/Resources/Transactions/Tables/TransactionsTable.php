<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Enums\TransactionDirectionEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->columns([
                TextColumn::make('date')
                    ->label(__('filament.transactions.column_date'))
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('description')
                    ->label(__('filament.transactions.column_description'))
                    ->searchable()
                    ->limit(40),

                TextColumn::make('amount')
                    ->label(__('filament.transactions.column_amount'))
                    ->money('DKK')
                    ->sortable(),

                TextColumn::make('direction')
                    ->label(__('filament.transactions.column_direction'))
                    ->badge()
                    ->sortable(),

                TextColumn::make('transactionType.name')
                    ->label(__('filament.transactions.column_type'))
                    ->placeholder(__('filament.transactions.placeholder_uncategorized'))
                    ->searchable(),

                TextColumn::make('transactionType.category.name')
                    ->label(__('filament.transactions.column_category'))
                    ->placeholder('—'),

                TextColumn::make('account.name')
                    ->label(__('filament.transactions.column_account'))
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('direction')
                    ->label(__('filament.transactions.filter_direction'))
                    ->options(TransactionDirectionEnum::class),

                SelectFilter::make('category')
                    ->relationship('transactionType.category', 'name')
                    ->label(__('filament.transactions.filter_category')),

                SelectFilter::make('transaction_type_id')
                    ->relationship('transactionType', 'name')
                    ->label(__('filament.transactions.filter_type')),

                Filter::make('uncategorized')
                    ->label(__('filament.transactions.filter_uncategorized'))
                    ->query(fn (Builder $query) => $query->whereNull('transaction_type_id')),

                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from')->label(__('filament.transactions.filter_from')),
                        DatePicker::make('until')->label(__('filament.transactions.filter_until')),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('date', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('date', '<=', $data['until']));
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
