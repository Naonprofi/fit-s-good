<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkerData>
 */
class WorkerDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "worker_gender" => fake()->randomElement(['male', 'female', 'other']),
            "worker_name" => fake()->name(),
            "worker_age" => fake()->numberBetween(18,99)
        ];
    }
}
