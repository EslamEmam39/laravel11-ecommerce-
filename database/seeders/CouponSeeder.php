<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'SALE10',
                'type' => 'percent',
                'value' => 10.00,
                'expires_at' => now()->addMonth(),
            ],
            [
                'code' => 'BLACKFRIDAY',
                'type' => 'percent',
                'value' => 25.00,
                'expires_at' => now()->addDays(10),
            ],
            [
                'code' => 'WELCOME5',
                'type' => 'fixed',
                'value' => 5.00,
                'expires_at' => now()->addMonth(),
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::firstOrCreate(['code' => $coupon['code']], $coupon);
        }
    }
}
