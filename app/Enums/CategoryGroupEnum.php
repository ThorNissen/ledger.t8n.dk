<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CategoryGroupEnum: string implements HasLabel
{
    case Income = 'income';
    case HousingUtilities = 'housing_utilities';
    case Transport = 'transport';
    case FoodGroceries = 'food_groceries';
    case PersonalCareHealth = 'personal_care_health';
    case Savings = 'savings';
    case Miscellaneous = 'miscellaneous';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Income => 'Income',
            self::HousingUtilities => 'Housing & Utilities',
            self::Transport => 'Transport',
            self::FoodGroceries => 'Food & Groceries',
            self::PersonalCareHealth => 'Personal Care & Health',
            self::Savings => 'Savings',
            self::Miscellaneous => 'Miscellaneous',
        };
    }
}
