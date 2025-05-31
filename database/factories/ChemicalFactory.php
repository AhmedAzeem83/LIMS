<?php

namespace Database\Factories;

use App\Models\Lab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chemical>
 */
class ChemicalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'cas_number' => $this->faker->unique()->bothify('##-##-#'),
            'quantity' => $this->faker->randomFloat(2, 1, 1000),
            'unit' => $this->faker->randomElement(['g', 'kg', 'L', 'mL']),
            'location' => $this->faker->word(),
            'expiry_date' => $this->faker->optional()->date(),
            'lab_id' => fn() => Lab::factory(),
        ];
    }
}
