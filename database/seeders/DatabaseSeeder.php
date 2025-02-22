<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            SalerSeeder::class,
            ProductSeeder::class,
            ImageSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
