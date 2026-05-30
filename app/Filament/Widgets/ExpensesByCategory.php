<?php

namespace App\Filament\Widgets;

use App\Enums\TransactionDirectionEnum;
use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class ExpensesByCategory extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = null;

    protected ?string $pollingInterval = null;

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 1;

    public function getHeading(): ?string
    {
        return __('filament.widgets.expenses_by_category');
    }

    protected function getData(): array
    {
        [$start, $end] = $this->resolvePeriod();

        $rows = Transaction::query()
            ->select('categories.name as category', DB::raw('SUM(transactions.amount) as total'))
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->join('categories', 'transaction_types.category_id', '=', 'categories.id')
            ->where('transactions.direction', TransactionDirectionEnum::Expense)
            ->when($start, fn ($query) => $query->where('transactions.date', '>=', $start))
            ->when($end, fn ($query) => $query->where('transactions.date', '<=', $end))
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();

        return [
            'datasets' => [
                [
                    'data' => $rows->pluck('total')->map(fn ($v) => round((float) $v, 2))->toArray(),
                    'backgroundColor' => self::palette($rows->count()),
                ],
            ],
            'labels' => $rows->pluck('category')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    /** @return array{0: Carbon|null, 1: Carbon|null} */
    private function resolvePeriod(): array
    {
        $period = $this->pageFilters['period'] ?? 'last_month';

        if (str_starts_with($period, 'year_')) {
            $year = (int) substr($period, 5);

            return [now()->setYear($year)->startOfYear(), now()->setYear($year)->endOfYear()];
        }

        return match ($period) {
            'this_month' => [now()->startOfMonth(), now()->endOfMonth()],
            'this_year' => [now()->startOfYear(), now()->endOfYear()],
            'last_year' => [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()],
            default => [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()],
        };
    }

    /** @return array<int, string> */
    private static function palette(int $count): array
    {
        $colors = [
            '#f87171', '#fca5a5', '#ef4444', '#dc2626',
            '#fb923c', '#fdba74', '#f97316', '#ea580c',
            '#fbbf24', '#fde68a',
        ];

        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[] = $colors[$i % count($colors)];
        }

        return $result;
    }
}
