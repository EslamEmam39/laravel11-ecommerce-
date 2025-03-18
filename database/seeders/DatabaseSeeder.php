<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Coupon::insert([
            ['code' => 'SALE10', 'discount' => 10, 'expires_at' => now()->addDays(30)],
            ['code' => 'BLACKFRIDAY', 'discount' => 25, 'expires_at' => now()->addDays(10)],
            ['code' => 'WELCOME5', 'discount' => 5, 'expires_at' => now()->addMonths(1)],
        ]);
    }
}
