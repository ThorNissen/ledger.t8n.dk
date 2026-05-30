<?php

namespace App\Filament\Resources\RuleSuggestions\Pages;

use App\Filament\Resources\RuleSuggestions\RuleSuggestionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRuleSuggestion extends EditRecord
{
    protected static string $resource = RuleSuggestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
