<?php

namespace Database\Factories;

use App\Models\Lab;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sample>
 */
class SampleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'sample_number' => $this->faker->unique()->numerify('SMP####'),
            'description' => $this->faker->sentence(8),
            'collected_at' => $this->faker->dateTimeThisYear(),
            'collected_by' => fn() => User::factory(),
            'lab_id' => fn() => Lab::factory(),
            'status' => $this->faker->randomElement(['received', 'processing', 'completed', 'archived']),
        ];
    }
}
