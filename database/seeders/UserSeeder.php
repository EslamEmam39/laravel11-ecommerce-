<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@ecommerce.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Create Regular Test User
        $user = User::firstOrCreate(
            ['email' => 'user@ecommerce.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('user123'),
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole('user');

        // Create random users using factory if available, or manually
        User::factory(5)->create()->each(function ($u) {
            $u->assignRole('user');
        });
    }
}
