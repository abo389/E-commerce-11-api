<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Ahmed', 'Mohamed', 'Ali', 'Salah', 'Khaled'];

        $prefix = 'https://abo389.github.io/image-server/images/avatar/';

        for ($i = 1; $i <= 5; $i++) {
            \App\Models\User::factory()->create([
                'name' => $names[$i-1],
                'email' => $names[$i-1].'@gmail.com',
                'avatar' => $prefix.$i.'.webp',
            ]);
        }
    }
}
