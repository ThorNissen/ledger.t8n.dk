<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AccountTypeEnum: string implements HasLabel
{
    case Checking = 'checking';
    case Savings = 'savings';
    case Cash = 'cash';
    case CreditCard = 'credit_card';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Checking => __('enums.checking'),
            self::Savings => __('enums.savings'),
            self::Cash => __('enums.cash'),
            self::CreditCard => __('enums.credit_card'),
        };
    }
}
