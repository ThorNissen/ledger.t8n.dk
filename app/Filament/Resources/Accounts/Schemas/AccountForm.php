<?php

namespace App\Filament\Resources\Accounts\Schemas;

use App\Enums\AccountTypeEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.accounts.field_name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('bank_name')
                    ->label(__('filament.accounts.field_bank_name'))
                    ->nullable()
                    ->maxLength(255),

                Select::make('type')
                    ->label(__('filament.accounts.field_type'))
                    ->options(AccountTypeEnum::class)
                    ->required(),

                TextInput::make('currency')
                    ->label(__('filament.accounts.field_currency'))
                    ->required()
                    ->default('DKK')
                    ->maxLength(10),

                Toggle::make('is_active')
                    ->label(__('filament.accounts.is_active'))
                    ->default(true),
            ]);
    }
}
