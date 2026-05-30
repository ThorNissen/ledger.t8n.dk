<?php

namespace App\Filament\Resources\RuleSuggestions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RuleSuggestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pattern')
                    ->required()
                    ->maxLength(255),

                TextInput::make('occurrences')
                    ->numeric()
                    ->disabled(),

                Select::make('suggested_transaction_type_id')
                    ->relationship('suggestedTransactionType', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Toggle::make('is_reviewed'),
                Toggle::make('is_accepted'),
            ]);
    }
}
