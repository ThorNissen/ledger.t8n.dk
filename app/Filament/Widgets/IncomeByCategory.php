<?php

namespace App\Filament\Widgets;

use App\Enums\TransactionDirectionEnum;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class IncomeByCategory extends ChartWidget
{
    protected ?string $heading = 'Income by Category';

    protected ?string $pollingInterval = null;

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    public ?string $filter = 'all';

    protected function getFilters(): ?array
    {
        return [
            'month' => 'This month',
            'quarter' => 'This quarter',
            'year' => 'This year',
            'all' => 'All time',
        ];
    }

    protected function getData(): array
    {
        $rows = Transaction::query()
            ->select('categories.name as category', DB::raw('SUM(transactions.amount) as total'))
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->join('categories', 'transaction_types.category_id', '=', 'categories.id')
            ->where('transactions.direction', TransactionDirectionEnum::Income)
            ->when($this->filter !== 'all', function ($query) {
                $query->where('transactions.date', '>=', match ($this->filter) {
                    'month' => now()->startOfMonth(),
                    'quarter' => now()->startOfQuarter(),
                    'year' => now()->startOfYear(),
                });
            })
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

    /** @return array<int, string> */
    private static function palette(int $count): array
    {
        $colors = [
            '#4ade80', '#86efac', '#22c55e', '#16a34a',
            '#6ee7b7', '#34d399', '#10b981', '#059669',
            '#a7f3d0', '#d1fae5',
        ];

        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[] = $colors[$i % count($colors)];
        }

        return $result;
    }
}
