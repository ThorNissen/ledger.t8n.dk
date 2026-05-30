<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Enums\TransactionDirectionEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->required(),

                TextInput::make('description')
                    ->required()
                    ->maxLength(255),

                TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                Select::make('direction')
                    ->options(TransactionDirectionEnum::class)
                    ->required(),

                Select::make('account_id')
                    ->relationship('account', 'name')
                    ->searchable()
                    ->preload(),

                Select::make('transaction_type_id')
                    ->relationship('transactionType', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Textarea::make('notes')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
