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
        $this->call([
            RoleAndPermission::class,
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            GeneralSettingSeeder::class,
            CouponSeeder::class,
            ProductViewedSeeder::class,
            CartSeeder::class,
            FavoriteSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            ContactUsSeeder::class,
        ]);
    }
}
