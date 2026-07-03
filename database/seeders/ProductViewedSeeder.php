<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductViewed;
use Illuminate\Database\Seeder;

class ProductViewedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return;
        }

        $ips = ['192.168.1.1', '192.168.1.5', '10.0.0.12', '172.16.254.1', '8.8.8.8'];

        foreach ($products as $product) {
            // Seed 2-5 views per product
            $viewCount = rand(2, 5);
            for ($i = 0; $i < $viewCount; $i++) {
                ProductViewed::create([
                    'ip' => $ips[array_rand($ips)],
                    'product_id' => (string)$product->id,
                ]);
            }
        }
    }
}
