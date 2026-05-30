<?php

namespace Database\Factories;

use App\Models\Import;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Import> */
class ImportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'filename' => fake()->word().'.csv',
            'rows_imported' => fake()->numberBetween(0, 500),
            'imported_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
