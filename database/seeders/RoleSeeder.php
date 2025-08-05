<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $clientRole = Role::create(['name' => 'client']);

        // Create permissions
        $permissions = [
            'view products',
            'view categories',
            'view orders',
            'manage products',
            'manage categories',
            'manage orders',
            'manage users',
            'view dashboard'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to admin role
        $adminRole->givePermissionTo($permissions);

        // Assign permissions to client role
        $clientRole->givePermissionTo([
            'view products',
            'view categories',
            'view orders'
        ]);
    }
}
