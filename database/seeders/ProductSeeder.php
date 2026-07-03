<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $fashion = Category::where('name', 'Fashion')->first();
        $books = Category::where('name', 'Books')->first();
        $beauty = Category::where('name', 'Beauty & Care')->first();
        $sports = Category::where('name', 'Sports & Outdoors')->first();

        $products = [
            // Electronics
            [
                'name' => 'iPhone 15 Pro',
                'category' => $electronics ? (string)$electronics->id : '1',
                'old_price' => '1200',
                'new_price' => '1000',
                'img' => 'products/iphone15.png',
                'des' => 'Latest iPhone 15 Pro with Titanium design, A17 Pro chip, and advanced camera system.',
                'isfeatured' => 1,
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'category' => $electronics ? (string)$electronics->id : '1',
                'old_price' => '1300',
                'new_price' => '1150',
                'img' => 'products/s24ultra.png',
                'des' => 'Samsung Galaxy S24 Ultra featuring Galaxy AI, 200MP camera, and built-in S Pen.',
                'isfeatured' => 1,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'category' => $electronics ? (string)$electronics->id : '1',
                'old_price' => '400',
                'new_price' => '350',
                'img' => 'products/sony_headphones.png',
                'des' => 'Industry-leading noise-canceling wireless over-ear headphones with Alexa voice control.',
                'isfeatured' => 0,
            ],

            // Fashion
            [
                'name' => 'Classic Leather Jacket',
                'category' => $fashion ? (string)$fashion->id : '2',
                'old_price' => '150',
                'new_price' => '120',
                'img' => 'products/leather_jacket.png',
                'des' => 'Premium quality classic black leather jacket for men. Slim fit and durable.',
                'isfeatured' => 1,
            ],
            [
                'name' => 'Casual Running Shoes',
                'category' => $fashion ? (string)$fashion->id : '2',
                'old_price' => '80',
                'new_price' => '65',
                'img' => 'products/running_shoes.png',
                'des' => 'Lightweight and breathable running shoes designed for ultimate comfort and support.',
                'isfeatured' => 0,
            ],

            // Books
            [
                'name' => 'Atomic Habits',
                'category' => $books ? (string)$books->id : '3',
                'old_price' => '20',
                'new_price' => '15',
                'img' => 'products/atomic_habits.png',
                'des' => 'An Easy & Proven Way to Build Good Habits & Break Bad Ones by James Clear.',
                'isfeatured' => 1,
            ],
            [
                'name' => 'The Alchemist',
                'category' => $books ? (string)$books->id : '3',
                'old_price' => '15',
                'new_price' => '12',
                'img' => 'products/alchemist.png',
                'des' => 'A magical story of Santiago, an Andalusian shepherd boy who yearns to travel in search of a worldly treasure.',
                'isfeatured' => 0,
            ],

            // Beauty & Care
            [
                'name' => 'Hydrating Face Serum',
                'category' => $beauty ? (string)$beauty->id : '4',
                'old_price' => '35',
                'new_price' => '28',
                'img' => 'products/face_serum.png',
                'des' => 'Pure Hyaluronic Acid serum for intense face hydration and anti-aging benefits.',
                'isfeatured' => 0,
            ],

            // Sports & Outdoors
            [
                'name' => 'Yoga Mat - Non-Slip',
                'category' => $sports ? (string)$sports->id : '5',
                'old_price' => '30',
                'new_price' => '22',
                'img' => 'products/yoga_mat.png',
                'des' => 'Eco-friendly, non-slip yoga mat with carrying strap. Perfect for home workouts.',
                'isfeatured' => 0,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(['name' => $product['name']], $product);
        }
    }
}
