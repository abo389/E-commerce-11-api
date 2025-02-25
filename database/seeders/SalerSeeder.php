<?php

namespace Database\Seeders;

use App\Models\Saler;
use Illuminate\Database\Seeder;

class SalerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Saler::factory(5)->create();
    }
}
