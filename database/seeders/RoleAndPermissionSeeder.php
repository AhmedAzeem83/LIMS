<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
       // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Lab management
            'manage labs',
            'view labs',
            
            // Device management
            'manage devices',
            'view devices',
            'calibrate devices',
            
            // Chemical inventory
            'manage chemicals',
            'view chemicals',
            
            // Sample management
            'manage samples',
            'view samples',
            'assign samples',
            
            // Test management
            'manage tests',
            'view tests',
            'perform tests',
            'approve tests',
            
            // Report management
            'generate reports',
            'view reports',
            
            // User management
            'manage users',
            'view users',
            
            // System management
            'manage system',
            'view system',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        $labManagerRole = Role::firstOrCreate(['name' => 'Lab Manager']);
        $labManagerRole->givePermissionTo([
            'view labs',
            'manage devices',
            'view devices',
            'calibrate devices',
            'manage chemicals',
            'view chemicals',
            'manage samples',
            'view samples',
            'assign samples',
            'manage tests',
            'view tests',
            'approve tests',
            'generate reports',
            'view reports',
            'view users',
        ]);

        $chemistSupervisorRole = Role::firstOrCreate(['name' => 'Chemist Supervisor']);
        $chemistSupervisorRole->givePermissionTo([
            'view labs',
            'view devices',
            'calibrate devices',
            'view chemicals',
            'manage samples',
            'view samples',
            'assign samples',
            'manage tests',
            'view tests',
            'perform tests',
            'approve tests',
            'generate reports',
            'view reports',
        ]);

        $labTechnicianRole = Role::firstOrCreate(['name' => 'Lab Technician']);
        $labTechnicianRole->givePermissionTo([
            'view labs',
            'view devices',
            'view chemicals',
            'view samples',
            'view tests',
            'perform tests',
            'view reports',
        ]);
    }
}
