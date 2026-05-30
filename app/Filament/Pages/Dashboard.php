<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('period')
                ->label(__('filament.widgets.filter_period'))
                ->options(fn (): array => [
                    __('filament.widgets.filter_group_current') => [
                        'this_month' => __('filament.widgets.filter_this_month'),
                        'last_month' => __('filament.widgets.filter_last_month'),
                        'this_year' => __('filament.widgets.filter_this_year'),
                        'last_year' => __('filament.widgets.filter_last_year'),
                    ],
                    __('filament.widgets.filter_group_years') => collect(range(now()->year - 1, now()->year - 5))
                        ->mapWithKeys(fn (int $year): array => ["year_{$year}" => (string) $year])
                        ->all(),
                ])
                ->default('last_month')
                ->selectablePlaceholder(false),
        ]);
    }
}
