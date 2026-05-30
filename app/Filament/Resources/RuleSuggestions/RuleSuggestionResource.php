<?php

namespace App\Filament\Resources\RuleSuggestions;

use App\Filament\Resources\RuleSuggestions\Pages\ListRuleSuggestions;
use App\Filament\Resources\RuleSuggestions\Tables\RuleSuggestionsTable;
use App\Models\RuleSuggestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RuleSuggestionResource extends Resource
{
    protected static ?string $model = RuleSuggestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function table(Table $table): Table
    {
        return RuleSuggestionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRuleSuggestions::route('/'),
        ];
    }
}
