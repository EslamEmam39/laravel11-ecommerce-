<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        // Create 3 orders for registered users
        for ($i = 0; $i < 3; $i++) {
            $user = $users->random();
            $orderProducts = $products->random(rand(1, 3));
            
            $productIds = [];
            $quantities = [];
            $total = 0;

            foreach ($orderProducts as $product) {
                $qty = rand(1, 2);
                $productIds[] = (string)$product->id;
                $quantities[] = (string)$qty;
                $total += $product->new_price * $qty;
            }

            Order::create([
                'user_id' => (string)$user->id,
                'user_ip' => null,
                'product_id' => json_encode($productIds),
                'quantity' => json_encode($quantities),
                'total' => (string)$total,
                'ref' => 'REF-' . strtoupper(Str::random(8)),
                'status' => ['pending', 'completed', 'canceled'][rand(0, 2)],
                'payment_method' => ['cod', 'card'][rand(0, 1)],
                'coupon_code' => rand(0, 1) ? 'SALE10' : null,
                'final_total' => $total * 0.9,
                'discount' => $total * 0.1,
            ]);
        }

        // Create 1 order for a guest user
        $guestProducts = $products->random(rand(1, 2));
        $productIds = [];
        $quantities = [];
        $total = 0;

        foreach ($guestProducts as $product) {
            $qty = rand(1, 2);
            $productIds[] = (string)$product->id;
            $quantities[] = (string)$qty;
            $total += $product->new_price * $qty;
        }

        Order::create([
            'user_id' => null,
            'user_ip' => '192.168.1.50',
            'product_id' => json_encode($productIds),
            'quantity' => json_encode($quantities),
            'total' => (string)$total,
            'ref' => 'REF-' . strtoupper(Str::random(8)),
            'status' => 'pending',
            'payment_method' => 'cod',
            'coupon_code' => null,
            'final_total' => $total,
            'discount' => 0,
        ]);
    }
}
