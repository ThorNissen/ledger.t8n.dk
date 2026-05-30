<?php

namespace Database\Factories;

use App\Models\Rule;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Rule> */
class RuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'transaction_type_id' => TransactionType::factory(),
            'keyword' => fake()->word(),
            'priority' => 100,
            'case_sensitive' => false,
            'is_enabled' => true,
        ];
    }

    public function disabled(): static
    {
        return $this->state(['is_enabled' => false]);
    }
}
