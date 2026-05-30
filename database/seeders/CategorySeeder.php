<?php

namespace Database\Seeders;

use App\Enums\CategoryGroupEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Income', 'group' => CategoryGroupEnum::Income, 'sort_order' => 1],
            ['name' => 'Housing & Utilities', 'group' => CategoryGroupEnum::HousingUtilities, 'sort_order' => 2],
            ['name' => 'Transport', 'group' => CategoryGroupEnum::Transport, 'sort_order' => 3],
            ['name' => 'Food & Groceries', 'group' => CategoryGroupEnum::FoodGroceries, 'sort_order' => 4],
            ['name' => 'Personal Care & Health', 'group' => CategoryGroupEnum::PersonalCareHealth, 'sort_order' => 5],
            ['name' => 'Savings', 'group' => CategoryGroupEnum::Savings, 'sort_order' => 6],
            ['name' => 'Miscellaneous', 'group' => CategoryGroupEnum::Miscellaneous, 'sort_order' => 7],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name'], 'user_id' => null],
                [
                    'group' => $category['group'],
                    'sort_order' => $category['sort_order'],
                    'is_system' => true,
                ]
            );
        }
    }
}
