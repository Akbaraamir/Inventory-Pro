<?php

namespace Database\Factories;

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
        'category_id' => \App\Models\Category::all()->random()->id,
        'name' => $this->faker->words(2, true),
        'sku' => strtoupper($this->faker->unique()->bothify('??-####')),
        'price' => $this->faker->randomFloat(2, 10, 2000),
        'quantity' => $this->faker->numberBetween(0, 50),
        'alert_level' => 10, // Items with <10 stock will trigger your alerts
    ];
}
}
