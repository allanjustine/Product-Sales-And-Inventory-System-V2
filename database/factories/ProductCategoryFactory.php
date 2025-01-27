<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Bread', 'Dairay', 'Fruit', 'Vegetables', 'Coffee', 'Tea', 'Juice', 'Soda', 'Alcohol', 'Beverages', 'Foods', 'Others'];

        $categoryName = $this->faker->unique()->randomElement($categories);

        return [
            'category_name' => $categoryName,
            'category_description' => fake()->sentence(),
        ];
    }
}
