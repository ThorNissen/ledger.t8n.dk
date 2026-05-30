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
                    ->required()
                    ->maxLength(255),

                TextInput::make('bank_name')
                    ->nullable()
                    ->maxLength(255),

                Select::make('type')
                    ->options(AccountTypeEnum::class)
                    ->required(),

                TextInput::make('currency')
                    ->required()
                    ->default('DKK')
                    ->maxLength(10),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
