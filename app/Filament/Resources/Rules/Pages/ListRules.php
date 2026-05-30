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
                ->label(__('filament.rules.recategorize_label'))
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading(__('filament.rules.recategorize_heading'))
                ->modalDescription(__('filament.rules.recategorize_description'))
                ->modalSubmitActionLabel(__('filament.rules.recategorize_submit'))
                ->action(function () {
                    CategorizeTransactionsJob::dispatch(auth()->id());

                    Notification::make()
                        ->title(__('filament.rules.recategorize_queued_title'))
                        ->body(__('filament.rules.recategorize_queued_body'))
                        ->success()
                        ->send();
                }),

            CreateAction::make(),
        ];
    }
}
