<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<TransactionType> */
class TransactionTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'name' => fake()->words(1, true),
            'is_system' => false,
        ];
    }

    public function system(): static
    {
        return $this->state(['user_id' => null, 'is_system' => true]);
    }
}
