<?php

namespace Database\Factories;

use App\Enums\TransactionDirectionEnum;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Transaction> */
class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'account_id' => Account::factory(),
            'transaction_type_id' => null,
            'date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'description' => fake()->sentence(3),
            'amount' => fake()->randomFloat(2, 1, 5000),
            'direction' => fake()->randomElement(TransactionDirectionEnum::cases())->value,
            'notes' => fake()->optional()->sentence(),
            'external_id' => null,
            'meta' => null,
        ];
    }

    public function uncategorized(): static
    {
        return $this->state(['transaction_type_id' => null]);
    }

    public function categorized(): static
    {
        return $this->state(['transaction_type_id' => TransactionType::factory()]);
    }

    public function expense(): static
    {
        return $this->state(['direction' => TransactionDirectionEnum::Expense->value]);
    }

    public function income(): static
    {
        return $this->state(['direction' => TransactionDirectionEnum::Income->value]);
    }
}
