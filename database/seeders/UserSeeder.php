<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin Marketplace',
            'email' => 'admin@marketplace.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Create test client
        $client = User::create([
            'name' => 'Client Test',
            'email' => 'client@marketplace.com',
            'password' => Hash::make('password'),
        ]);
        $client->assignRole('client');

        // Create test sellers
        $seller1 = User::create([
            'name' => 'Vendeur Électronique',
            'email' => 'seller1@marketplace.com',
            'password' => Hash::make('password'),
        ]);
        $seller1->assignRole('seller');

        $seller2 = User::create([
            'name' => 'Vendeur Mode',
            'email' => 'seller2@marketplace.com',
            'password' => Hash::make('password'),
        ]);
        $seller2->assignRole('seller');

        $seller3 = User::create([
            'name' => 'Vendeur Sport',
            'email' => 'seller3@marketplace.com',
            'password' => Hash::make('password'),
        ]);
        $seller3->assignRole('seller');

        // Create additional clients
        $client2 = User::create([
            'name' => 'Marie Dupont',
            'email' => 'marie@example.com',
            'password' => Hash::make('password'),
        ]);
        $client2->assignRole('client');

        $client3 = User::create([
            'name' => 'Jean Martin',
            'email' => 'jean@example.com',
            'password' => Hash::make('password'),
        ]);
        $client3->assignRole('client');
    }
}
