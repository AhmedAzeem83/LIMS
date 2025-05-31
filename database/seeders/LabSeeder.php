<?php

namespace Database\Seeders;

use App\Models\Lab;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lab::create([
            'name' => 'Main Laboratory',
            'location' => 'Houston, TX',
            'description' => 'Main oil and gas testing facility',
            'status' => 'active',
        ]);

        Lab::create([
            'name' => 'Secondary Laboratory',
            'location' => 'Dallas, TX',
            'description' => 'Secondary testing facility for overflow work',
            'status' => 'active',
        ]);

        Lab::create([
            'name' => 'Research Laboratory',
            'location' => 'Austin, TX',
            'description' => 'Research and development facility',
            'status' => 'active',
        ]);
    }
}
