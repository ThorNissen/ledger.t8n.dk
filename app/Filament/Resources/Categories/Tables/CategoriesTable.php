<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Enums\CategoryGroupEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                ColorColumn::make('color')
                    ->label('')
                    ->width('40px'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('group')
                    ->badge()
                    ->sortable(),

                TextColumn::make('transactionTypes_count')
                    ->counts('transactionTypes')
                    ->label(__('filament.categories.column_types')),

                IconColumn::make('is_system')
                    ->boolean()
                    ->label(__('filament.categories.column_system')),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options(CategoryGroupEnum::class),
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
