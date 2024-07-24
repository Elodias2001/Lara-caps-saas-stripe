<?php

namespace Database\Factories;
use Illuminate\Support\Str;
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
            'name' => Str::random(),
            'price' => fake()->numberBetween(1000, 100000),
            'stripe_product_id' => Str::random(),

            // 'name' => $this->faker->word,
            // 'price' => $this->faker->numberBetween(1000, 100000),
            // 'stripe_product_id' => $this->faker->sentence,
        ];
    }
}
