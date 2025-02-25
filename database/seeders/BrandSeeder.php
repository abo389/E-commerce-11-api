<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents(__DIR__ . '/data/brands.json');
        $brands = json_decode($jsonData, true);

        foreach ($brands as $brand) {
            \App\Models\Brand::create([
                "name" => $brand,
            ]);
        }
    }
}
