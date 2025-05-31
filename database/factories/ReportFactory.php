<?php

namespace Database\Factories;

use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'report_number' => $this->faker->unique()->numerify('RPT####'),
            'title' => $this->faker->sentence(4),
            'generated_at' => $this->faker->dateTimeThisYear(),
            'generated_by' => fn() => User::factory(),
            'file_path' => $this->faker->filePath(),
            'test_id' => fn() => Test::factory(),
        ];
    }
}
