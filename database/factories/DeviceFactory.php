<?php

namespace Database\Factories;

use App\Models\Lab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Device',
            'model' => $this->faker->bothify('Model-####'),
            'serial_number' => $this->faker->unique()->bothify('SN#######'),
            'manufacturer' => $this->faker->company(),
            'purchase_date' => $this->faker->date(),
            'last_calibration_date' => $this->faker->optional()->date(),
            'next_calibration_date' => $this->faker->optional()->date(),
            'status' => $this->faker->randomElement(['operational', 'maintenance', 'out_of_order']),
            'lab_id' => fn() => Lab::factory(),
        ];
    }
}
