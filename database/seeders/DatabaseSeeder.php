<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            SalerSeeder::class,
            ProductSeeder::class,
            ImageSeeder::class,
        ]);
    }
}

//  ( "price", "stock", "discount", "saler_id", "category_id", "brand_id") 
//  values ( 110, 120, 10, 3, 15, 12)