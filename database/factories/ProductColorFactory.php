<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductColor>
 */
class ProductColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colors = [
            'white',
            'black',
            'red',
            'blue',
            'green',
            'yellow',
            'orange',
        ];

        return [
            'product_id' => $this->faker->numberBetween(1, 500),
            'name' => $this->faker->randomElement($colors),
            'stock' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
