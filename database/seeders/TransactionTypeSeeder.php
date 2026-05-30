<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Food & Groceries' => ['Groceries', 'Takeout'],
            'Transport' => ['Fuel', 'Parking', 'Public Transport'],
            'Personal Care & Health' => ['Fitness', 'Pharmacy', 'Doctor'],
            'Housing & Utilities' => ['Internet', 'Electricity', 'Rent'],
            'Miscellaneous' => ['Subscriptions', 'Shopping', 'Entertainment'],
            'Income' => ['Salary', 'Freelance', 'Refund'],
            'Savings' => ['Transfer to Savings'],
        ];

        foreach ($types as $categoryName => $typeNames) {
            $category = Category::whereNull('user_id')->where('name', $categoryName)->first();

            if (! $category) {
                continue;
            }

            foreach ($typeNames as $typeName) {
                TransactionType::firstOrCreate(
                    ['name' => $typeName, 'user_id' => null, 'category_id' => $category->id],
                    ['is_system' => true]
                );
            }
        }
    }
}
