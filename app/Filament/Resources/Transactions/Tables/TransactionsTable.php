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
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('description')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('amount')
                    ->money('DKK')
                    ->sortable(),

                TextColumn::make('direction')
                    ->badge()
                    ->sortable(),

                TextColumn::make('transactionType.name')
                    ->label('Type')
                    ->placeholder('Uncategorized')
                    ->searchable(),

                TextColumn::make('transactionType.category.name')
                    ->label('Category')
                    ->placeholder('—'),

                TextColumn::make('account.name')
                    ->label('Account')
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('direction')
                    ->options(TransactionDirectionEnum::class),

                SelectFilter::make('category')
                    ->relationship('transactionType.category', 'name')
                    ->label('Category'),

                SelectFilter::make('transaction_type_id')
                    ->relationship('transactionType', 'name')
                    ->label('Type'),

                Filter::make('uncategorized')
                    ->label('Uncategorized only')
                    ->query(fn (Builder $query) => $query->whereNull('transaction_type_id')),

                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
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
