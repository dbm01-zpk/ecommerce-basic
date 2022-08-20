<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'        => 'pepe el toro',
            'description' => fake()->paragraph,
            'price'       => fake()->randomFloat(2, 0, 10000),
            'status'      => fake()->boolean,
        ];
    }
}
