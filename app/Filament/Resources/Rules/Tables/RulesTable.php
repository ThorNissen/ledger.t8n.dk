<?php

namespace App\Filament\Resources\Rules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('priority')
            ->columns([
                TextColumn::make('keyword')
                    ->label(__('filament.rules.column_keyword'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('transactionType.name')
                    ->label(__('filament.rules.column_type'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('transactionType.category.name')
                    ->label(__('filament.rules.column_category')),

                TextColumn::make('priority')
                    ->label(__('filament.rules.column_priority'))
                    ->sortable(),

                IconColumn::make('case_sensitive')
                    ->boolean()
                    ->label(__('filament.rules.column_case')),

                IconColumn::make('is_enabled')
                    ->boolean()
                    ->label(__('filament.rules.column_enabled')),
            ])
            ->filters([
                Filter::make('enabled')
                    ->label(__('filament.rules.filter_enabled'))
                    ->default()
                    ->query(fn (Builder $query) => $query->where('is_enabled', true)),
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
