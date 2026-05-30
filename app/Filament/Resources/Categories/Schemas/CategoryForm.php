<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Enums\CategoryGroupEnum;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('group')
                    ->options(CategoryGroupEnum::class)
                    ->required(),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),

                ColorPicker::make('color')
                    ->nullable(),

                Toggle::make('is_system')
                    ->default(false),
            ]);
    }
}
