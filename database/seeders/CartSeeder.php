<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
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

        // Add 1-2 items to cart for a couple of users
        $testUsers = $users->take(3);

        foreach ($testUsers as $user) {
            $randomProducts = $products->random(rand(1, 2));
            foreach ($randomProducts as $product) {
                Cart::create([
                    'user_id' => (string)$user->id,
                    'user_ip' => '127.0.0.1',
                    'product_id' => (string)$product->id,
                    'quantity' => (string)rand(1, 3),
                ]);
            }
        }

        // Add 1 guest cart entry
        $randomProduct = $products->random();
        Cart::create([
            'user_id' => null,
            'user_ip' => '192.168.1.10',
            'product_id' => (string)$randomProduct->id,
            'quantity' => '1',
        ]);
    }
}
