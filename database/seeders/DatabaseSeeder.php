<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@luxora.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Create test user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('client');
    }
}
