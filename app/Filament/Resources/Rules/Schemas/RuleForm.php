<?php

namespace App\Filament\Resources\Rules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('keyword')
                    ->required()
                    ->maxLength(255),

                Select::make('transaction_type_id')
                    ->relationship('transactionType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('priority')
                    ->numeric()
                    ->default(100)
                    ->required(),

                Toggle::make('case_sensitive')
                    ->default(false),

                Toggle::make('is_enabled')
                    ->default(true),
            ]);
    }
}
