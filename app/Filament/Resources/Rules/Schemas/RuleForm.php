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
                    ->label(__('filament.rules.field_keyword'))
                    ->required()
                    ->maxLength(255),

                Select::make('transaction_type_id')
                    ->label(__('filament.rules.field_transaction_type'))
                    ->relationship('transactionType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('priority')
                    ->label(__('filament.rules.field_priority'))
                    ->numeric()
                    ->default(100)
                    ->required(),

                Toggle::make('case_sensitive')
                    ->label(__('filament.rules.field_case_sensitive'))
                    ->default(false),

                Toggle::make('is_enabled')
                    ->label(__('filament.rules.field_is_enabled'))
                    ->default(true),
            ]);
    }
}
