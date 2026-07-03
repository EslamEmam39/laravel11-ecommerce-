<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'order' => '1',
                'img' => 'category/electronics.png',
            ],
            [
                'name' => 'Fashion',
                'order' => '2',
                'img' => 'category/fashion.png',
            ],
            [
                'name' => 'Books',
                'order' => '3',
                'img' => 'category/books.png',
            ],
            [
                'name' => 'Beauty & Care',
                'order' => '4',
                'img' => 'category/beauty.png',
            ],
            [
                'name' => 'Sports & Outdoors',
                'order' => '5',
                'img' => 'category/sports.png',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
