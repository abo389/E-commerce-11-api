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
        $brands = ['LG', "Samsoung", "Haier", "Daikin", "Godrej", "IFB", "Panasonic"];

        foreach ($brands as $brand) {
            \App\Models\Brand::create([
                "name" => $brand,
            ]);
        }
    }
}
