<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSize>
 */
class ProductSizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sizes = [
            'small',
            'medium',
            'large',
            'extra large',
            '2xl',
            '3xl',
            '4xl',
        ];

        return [
            'product_id' => $this->faker->numberBetween(1, 500),
            'name' => $this->faker->randomElement($sizes),
            'stock' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
