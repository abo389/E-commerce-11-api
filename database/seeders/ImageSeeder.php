<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // eatch product has 1 to 5 images
        $product_count = Product::all()->count();
        for ($i = 0; $i < $product_count; $i++) {
            Image::factory(rand(1, 2))->create([
                'product_id' => $i + 1
            ]);
        }
    }
}
