<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default admin user and assign Admin role
        $admin = \App\Models\User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
        ]);
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $admin->assignRole('Admin');
        }

        // Seed labs with specific names
        $labNames = ['Central Lab', 'Chemistry Lab', 'Physics Lab'];
        foreach ($labNames as $name) {
            \App\Models\Lab::factory()->create(['name' => $name]);
        }

        $this->call([
            RoleAndPermissionSeeder::class,
            // Add other seeders as needed
        ]);
    }
}
