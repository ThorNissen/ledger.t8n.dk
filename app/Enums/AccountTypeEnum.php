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
            self::Checking => 'Checking',
            self::Savings => 'Savings',
            self::Cash => 'Cash',
            self::CreditCard => 'Credit Card',
        };
    }
}
