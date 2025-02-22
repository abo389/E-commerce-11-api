<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['clothing', 'shoes', 'accessories', 'electronics', 'home', 'beauty', 'food', 'health', 'sports', 'toys'];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                "name" => $category,
            ]);
        }
    }
}
