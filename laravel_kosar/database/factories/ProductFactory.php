<?php

namespace Database\Factories;

use App\Models\ProductType;
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
            'type_id' => ProductType::all()->random()->type_id,
            // feladatmeghatározás szerint most csak 1 db kell, hogy legyen mindenből
            'quantity' => 1,
            'date' => fake()->date(),
        ];
    }
}
