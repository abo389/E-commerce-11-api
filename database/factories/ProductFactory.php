<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Saler;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "description" => $this->faker->paragraph(),
            "price" => $this->faker->randomFloat(2, 10, 1000),
            "stock" => $this->faker->numberBetween(0, 100),
            "discount" => $this->faker->numberBetween(0, 80),
            "category_id" => Category::all()->random()->id,
            "brand_id" => Brand::all()->random()->id,
            "saler_id" => Saler::all()->random()->id,
            "delivery_time" => now()->addDays($this->faker->numberBetween(1, 7)),
        ];
    }
}
