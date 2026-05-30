<?php

namespace Database\Factories;

use App\Enums\CategoryGroupEnum;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Category> */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->words(2, true),
            'group' => fake()->randomElement(CategoryGroupEnum::cases())->value,
            'sort_order' => fake()->numberBetween(0, 100),
            'color' => fake()->optional()->hexColor(),
            'icon' => null,
            'is_system' => false,
        ];
    }

    public function system(): static
    {
        return $this->state(['user_id' => null, 'is_system' => true]);
    }
}
