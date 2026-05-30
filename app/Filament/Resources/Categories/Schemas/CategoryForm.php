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
                    ->label(__('filament.categories.field_name'))
                    ->required()
                    ->maxLength(255),

                Select::make('group')
                    ->label(__('filament.categories.field_group'))
                    ->options(CategoryGroupEnum::class)
                    ->required(),

                TextInput::make('sort_order')
                    ->label(__('filament.categories.field_sort_order'))
                    ->numeric()
                    ->default(0),

                ColorPicker::make('color')
                    ->label(__('filament.categories.field_color'))
                    ->nullable(),

                Toggle::make('is_system')
                    ->label(__('filament.categories.field_is_system'))
                    ->default(false),
            ]);
    }
}
