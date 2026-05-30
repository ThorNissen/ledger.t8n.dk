<?php

namespace App\Filament\Resources\Rules\Pages;

use App\Filament\Resources\Rules\RuleResource;
use App\Jobs\CategorizeTransactionsJob;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListRules extends ListRecords
{
    protected static string $resource = RuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('recategorize')
                ->label('Re-run Categorization')
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Re-run Categorization')
                ->modalDescription('This will apply all enabled rules to your uncategorized transactions. Already categorized transactions will not be changed.')
                ->modalSubmitActionLabel('Run')
                ->action(function () {
                    CategorizeTransactionsJob::dispatch(auth()->id());

                    Notification::make()
                        ->title('Categorization queued')
                        ->body('Your transactions are being categorized in the background.')
                        ->success()
                        ->send();
                }),

            CreateAction::make(),
        ];
    }
}
