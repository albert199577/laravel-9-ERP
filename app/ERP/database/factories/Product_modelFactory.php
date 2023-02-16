<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Product_modelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word(),
            'color' => fake()->safeColorName(),
            'cost' => fake()->numerify('##'),
            'price' => fake()->numerify('##0'),
            'stock' => fake()->numerify('1##'),
            'cargo_id' => fake()->regexify('[A-Z]{5}-[0-9]{4}'),
        ];
    }
}
