<?php

namespace Database\Factories;

use App\Models\Lab;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'test_type' => $this->faker->randomElement(['density', 'viscosity', 'flash_point', 'pour_point', 'water_content', 'sulfur_content', 'composition', 'other']),
            'method' => $this->faker->word(),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'approved', 'rejected']),
            'started_at' => $this->faker->optional()->dateTimeThisYear(),
            'completed_at' => $this->faker->optional()->dateTimeThisYear(),
            'results' => null,
            'notes' => $this->faker->optional()->sentence(),
            'sample_id' => fn() => \App\Models\Sample::factory(),
            'device_id' => fn() => \App\Models\Device::factory(),
            'assigned_to' => fn() => User::factory(),
            'approved_by' => fn() => User::factory(),
            'lab_id' => fn() => Lab::factory(),
        ];
    }
}
