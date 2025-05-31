<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lab>
 */
class LabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Laboratory',
            'location' => $this->faker->city . ', ' . $this->faker->stateAbbr,
            'description' => $this->faker->sentence(6),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
