<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands_count = Brand::all()->count();
        // eatch brand has 5 products
        for ($i = 1; $i <= $brands_count; $i++) {
            Product::factory(5)->create([
                'brand_id' => $i,
            ]);
        }

        $categories_count = Category::all()->count();
        // eatch category has 5 products
        for ($i = 1; $i <= $categories_count; $i++) {
            Product::factory(5)->create([
                'category_id' => $i,
            ]);
        }
    }
}
