<?php

namespace App\Filament\Resources\TransactionTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TransactionTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.transaction_types.column_name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label(__('filament.transaction_types.column_category'))
                    ->sortable(),

                TextColumn::make('category.group')
                    ->label(__('filament.transaction_types.column_group'))
                    ->badge(),

                IconColumn::make('is_system')
                    ->boolean()
                    ->label(__('filament.transaction_types.column_system')),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label(__('filament.transaction_types.filter_category')),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
