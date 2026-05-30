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
            self::Income => __('enums.income'),
            self::HousingUtilities => __('enums.housing_utilities'),
            self::Transport => __('enums.transport'),
            self::FoodGroceries => __('enums.food_groceries'),
            self::PersonalCareHealth => __('enums.personal_care_health'),
            self::Savings => __('enums.savings'),
            self::Miscellaneous => __('enums.miscellaneous'),
        };
    }
}
