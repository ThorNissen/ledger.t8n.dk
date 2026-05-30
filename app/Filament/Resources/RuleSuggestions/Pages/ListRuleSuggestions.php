<?php

namespace App\Filament\Resources\RuleSuggestions\Pages;

use App\Filament\Resources\RuleSuggestions\RuleSuggestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRuleSuggestions extends ListRecords
{
    protected static string $resource = RuleSuggestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
