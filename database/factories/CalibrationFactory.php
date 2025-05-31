<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calibration>
 */
class CalibrationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'device_id' => fn() => Device::factory(),
            'performed_at' => $this->faker->dateTimeThisYear(),
            'performed_by' => fn() => User::factory(),
            'result' => $this->faker->sentence(4),
            'next_due' => $this->faker->optional()->date(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
