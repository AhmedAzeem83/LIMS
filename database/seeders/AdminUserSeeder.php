<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@lims.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        
        // $admin->assignRole('Admin');

        $labManager = User::create([
            'name' => 'Lab Manager',
            'email' => 'manager@lims.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        
        // $labManager->assignRole('Lab Manager');

        $chemistSupervisor = User::create([
            'name' => 'Chemist Supervisor',
            'email' => 'supervisor@lims.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        
        // $chemistSupervisor->assignRole('Chemist Supervisor');

        $labTechnician = User::create([
            'name' => 'Lab Technician',
            'email' => 'technician@lims.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        
        // $labTechnician->assignRole('Lab Technician');
    }
}
