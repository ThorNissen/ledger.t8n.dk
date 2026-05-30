<?php

namespace App\Filament\Resources\Rules\Tables;

use Filament\Actions\BulkActionGroup;
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
                    ->searchable()
                    ->sortable(),

                TextColumn::make('transactionType.name')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('transactionType.category.name')
                    ->label('Category'),

                TextColumn::make('priority')
                    ->sortable(),

                IconColumn::make('case_sensitive')
                    ->boolean()
                    ->label('Case'),

                IconColumn::make('is_enabled')
                    ->boolean()
                    ->label('Enabled'),
            ])
            ->filters([
                Filter::make('enabled')
                    ->label('Enabled only')
                    ->default()
                    ->query(fn (Builder $query) => $query->where('is_enabled', true)),
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
