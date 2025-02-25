<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $product_count = Product::all()->count();
        // // eatch product has 3 to 10 reviews
        // for ($i = 1; $i <= $product_count; $i++) {
        //     $review_count = rand(3, 3);
        //     for ($j = 1; $j <= $review_count; $j++) {
        //         Review::factory()->create([
        //             'product_id' => $i,
        //         ]);
        //     }
        // }
    }
}
