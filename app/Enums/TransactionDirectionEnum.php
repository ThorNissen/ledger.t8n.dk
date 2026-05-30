<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TransactionDirectionEnum: string implements HasColor, HasLabel
{
    case Income = 'income';
    case Expense = 'expense';
    case Transfer = 'transfer';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Income => __('enums.income'),
            self::Expense => __('enums.expense'),
            self::Transfer => __('enums.transfer'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Income => 'success',
            self::Expense => 'danger',
            self::Transfer => 'warning',
        };
    }
}
