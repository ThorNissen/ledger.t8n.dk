<?php

namespace Database\Factories;

use App\Models\RuleSuggestion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<RuleSuggestion> */
class RuleSuggestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'pattern' => strtolower(fake()->words(2, true)),
            'occurrences' => fake()->numberBetween(2, 30),
            'suggested_transaction_type_id' => null,
            'is_reviewed' => false,
            'is_accepted' => false,
        ];
    }

    public function reviewed(): static
    {
        return $this->state(['is_reviewed' => true]);
    }

    public function accepted(): static
    {
        return $this->state(['is_reviewed' => true, 'is_accepted' => true]);
    }
}
