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
        $product_nameFake = fake()->numberBetween(4, 8);
        $randomTimestamp = now()->subDays(rand(1, 30))->addHours(rand(0, 23))->addMinutes(rand(0, 59))->addSeconds(rand(0, 59));
        $price = fake()->randomFloat(2, 10, 1000000);

        return [
            'product_category_id' => fake()->numberBetween(1, 18),
            'product_name' => fake()->words($product_nameFake, true),
            'product_description' => fake()->sentence(),
            'product_status' => fake()->randomElement(['Available', 'Not Available']),
            'product_stock' => fake()->numberBetween(1, 100000),
            'product_price' => $price,
            'product_old_price' => $price + fake()->randomFloat(2, 0.00, 1000000.00),
            'product_code' => 'AJM-' . fake()->unique()->bothify('??#?#?##'),
            'created_at' => $randomTimestamp,
            'updated_at' => $randomTimestamp,
        ];
    }
}
