<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustData>
 */
class CustDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "cust_gender" => fake()->randomElement(['male', 'female', 'other']),
            "cust_name" => fake()->name(),
            "cust_age" => fake()->numberBetween(18,99)
        ];
    }
}
