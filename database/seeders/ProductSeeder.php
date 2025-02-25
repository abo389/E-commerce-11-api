<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents(__DIR__ . '/data/products.json');
        $jsonDataC = file_get_contents(__DIR__ . '/data/subCategory.json');
        $jsonDataB = file_get_contents(__DIR__ . '/data/brands.json');
        $brands = json_decode($jsonDataB, true);
        $categories = json_decode($jsonDataC, true);
        $products = json_decode($jsonData, true);

        foreach ($products as $k => $product) {
            Product::create([
                "name" => $product['name'],
                "description" => $product['description'],
                "price" => $product['price'],
                "stock" => $product['stock'],
                "discount" => $product['discount'],
                "saler_id" => round(rand(1, 5)),
                "category_id" => $categories[$product['category']],
                "brand_id" => $brands[$product['brand']],
            ]);
            foreach ($product['reviews'] as $review) {
                Review::create([
                    "product_id" => $k + 1,
                    "user_id" => round(rand(1, 5)),
                    "title" => $review['title'],
                    "rating" => $review['rating'],
                    "comment" => $review['comment'],
                    "is_approved" => $review['is_approved'],
                ]);
            }
        }
    }
}
