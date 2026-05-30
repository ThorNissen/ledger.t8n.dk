<?php

namespace App\Filament\Resources\TransactionTypes;

use App\Filament\Resources\TransactionTypes\Pages\ListTransactionTypes;
use App\Filament\Resources\TransactionTypes\Schemas\TransactionTypeForm;
use App\Filament\Resources\TransactionTypes\Tables\TransactionTypesTable;
use App\Models\TransactionType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransactionTypeResource extends Resource
{
    protected static ?string $model = TransactionType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TransactionTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransactionTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransactionTypes::route('/'),
        ];
    }
}
