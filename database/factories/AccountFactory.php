<?php

namespace Database\Factories;

use App\Enums\AccountTypeEnum;
use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Account> */
class AccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->words(2, true),
            'bank_name' => fake()->optional()->company(),
            'type' => fake()->randomElement(AccountTypeEnum::cases())->value,
            'currency' => 'DKK',
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}
