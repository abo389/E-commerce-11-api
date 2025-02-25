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
        $jsonData = file_get_contents(__DIR__ . '/data/imageCount.json');
        $data = json_decode($jsonData, true);
        $prefix = 'https://abo389.github.io/image-server/images/products/';
        $product_count = Product::all()->count();
        for ($i = 1; $i <= $product_count; $i++) {
            $m = $i == 10 ? '.avif' : '.jpg';
            for ($k=1; $k <= $data[$i]; $k++) { 
                    Image::create([
                        'product_id' => $i,
                        'link' => $prefix."$i/".$k.$m,
                    ]);
            }
        }
    }
}
