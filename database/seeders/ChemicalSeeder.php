<?php

namespace Database\Seeders;

use App\Models\Chemical;
use App\Models\Lab;
use Illuminate\Database\Seeder;

class ChemicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labs = Lab::all();

        foreach ($labs as $lab) {
            Chemical::create([
                'name' => 'Methanol',
                'cas_number' => '67-56-1',
                'category' => 'Solvent',
                'quantity' => 20,
                'unit' => 'L',
                'location' => 'Cabinet A1',
                'expiry_date' => now()->addYears(2),
                'lab_id' => $lab->id,
            ]);

            Chemical::create([
                'name' => 'Hexane',
                'cas_number' => '110-54-3',
                'category' => 'Solvent',
                'quantity' => 15,
                'unit' => 'L',
                'location' => 'Cabinet A2',
                'expiry_date' => now()->addYears(1),
                'lab_id' => $lab->id,
            ]);

            Chemical::create([
                'name' => 'Sulfuric Acid',
                'cas_number' => '7664-93-9',
                'category' => 'Acid',
                'quantity' => 5,
                'unit' => 'L',
                'location' => 'Cabinet B1',
                'expiry_date' => now()->addYears(3),
                'lab_id' => $lab->id,
            ]);
        }
    }
}
