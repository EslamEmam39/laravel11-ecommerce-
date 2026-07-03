<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
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

        // Add 1-2 favorites for some users
        $testUsers = $users->take(3);

        foreach ($testUsers as $user) {
            $randomProducts = $products->random(rand(1, 2));
            foreach ($randomProducts as $product) {
                Favorite::create([
                    'user_id' => (string)$user->id,
                    'user_ip' => '127.0.0.1',
                    'product_id' => (string)$product->id,
                ]);
            }
        }
    }
}
