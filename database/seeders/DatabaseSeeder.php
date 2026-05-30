<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            TransactionTypeSeeder::class,
        ]);

        User::firstOrCreate(
            ['email' => env('SEED_USER_EMAIL', 'test@example.com')],
            [
                'name' => env('SEED_USER_NAME', 'Test User'),
                'password' => env('SEED_USER_PASSWORD', 'password'),
            ]
        );
    }
}
