<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Lab;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labs = Lab::all();

        foreach ($labs as $lab) {
            Device::create([
                'name' => 'Gas Chromatograph',
                'model' => 'GC-2020',
                'serial_number' => 'GC' . $lab->id . '-001',
                'manufacturer' => 'Shimadzu',
                'purchase_date' => now()->subYears(2),
                'last_calibration_date' => now()->subMonths(3),
                'next_calibration_date' => now()->addMonths(3),
                'status' => 'operational',
                'lab_id' => $lab->id,
            ]);

            Device::create([
                'name' => 'Viscometer',
                'model' => 'SVM-3000',
                'serial_number' => 'VM' . $lab->id . '-001',
                'manufacturer' => 'Anton Paar',
                'purchase_date' => now()->subYears(1),
                'last_calibration_date' => now()->subMonths(2),
                'next_calibration_date' => now()->addMonths(4),
                'status' => 'operational',
                'lab_id' => $lab->id,
            ]);

            Device::create([
                'name' => 'Flash Point Tester',
                'model' => 'FP-93',
                'serial_number' => 'FP' . $lab->id . '-001',
                'manufacturer' => 'Koehler',
                'purchase_date' => now()->subMonths(18),
                'last_calibration_date' => now()->subMonths(1),
                'next_calibration_date' => now()->addMonths(5),
                'status' => 'operational',
                'lab_id' => $lab->id,
            ]);
        }
    }
}
