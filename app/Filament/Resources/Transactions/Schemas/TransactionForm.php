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
                    ->label(__('filament.transactions.field_date'))
                    ->required(),

                TextInput::make('description')
                    ->label(__('filament.transactions.field_description'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('amount')
                    ->label(__('filament.transactions.field_amount'))
                    ->numeric()
                    ->required()
                    ->minValue(0),

                Select::make('direction')
                    ->label(__('filament.transactions.field_direction'))
                    ->options(TransactionDirectionEnum::class)
                    ->required(),

                Select::make('account_id')
                    ->label(__('filament.transactions.field_account'))
                    ->relationship('account', 'name')
                    ->searchable()
                    ->preload(),

                Select::make('transaction_type_id')
                    ->label(__('filament.transactions.field_transaction_type'))
                    ->relationship('transactionType', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Textarea::make('notes')
                    ->label(__('filament.transactions.field_notes'))
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
