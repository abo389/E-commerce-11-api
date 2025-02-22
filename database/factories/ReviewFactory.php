<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence(),
            "comment" => $this->faker->paragraph(),
            "rating" => $this->faker->numberBetween(1,5),
            "user_id" => User::all()->random()->id,
            "product_id" => Product::all()->random()->id,
            "is_approved" => $this->faker->boolean(),
        ];
    }
}
