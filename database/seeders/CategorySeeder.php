<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Smartphones', 'Laptops', 'Cameras', 'Accessories',
            'Headphones', 'Speakers', 'Smart Watches', 'Televisions',
            'Gaming Consoles', 'Books', 'Clothing', 'Shoes',
            'Beauty Products', 'Home Appliances', 'Furniture',
            'Gardening Tools', 'Sports Equipment', 'Toys',
            'Pet Supplies', 'Groceries'
        ];

        foreach ($categories as $categoryName) {
            DB::table('categories')->insert([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
