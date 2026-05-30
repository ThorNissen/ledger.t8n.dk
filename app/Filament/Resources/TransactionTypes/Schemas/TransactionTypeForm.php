<?php

namespace App\Filament\Resources\TransactionTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TransactionTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.transaction_types.field_name'))
                    ->required()
                    ->maxLength(255),

                Select::make('category_id')
                    ->label(__('filament.transaction_types.field_category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Toggle::make('is_system')
                    ->label(__('filament.transaction_types.field_is_system'))
                    ->default(false),
            ]);
    }
}
