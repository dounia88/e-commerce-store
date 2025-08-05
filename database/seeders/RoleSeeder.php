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
        // Créer les rôles
        $adminRole = Role::create(['name' => 'admin']);
        $sellerRole = Role::create(['name' => 'seller']);
        $clientRole = Role::create(['name' => 'client']);

        // Créer les permissions
        $permissions = [
            // Permissions produits
            'view products',
            'create products',
            'edit products',
            'delete products',
            'manage products',
            
            // Permissions catégories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            'manage categories',
            
            // Permissions commandes
            'view orders',
            'manage orders',
            'update order status',
            
            // Permissions utilisateurs
            'view users',
            'manage users',
            
            // Permissions admin
            'access admin panel',
            'view dashboard',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assigner toutes les permissions au rôle admin
        $adminRole->givePermissionTo(Permission::all());

        // Assigner les permissions de vendeur au rôle seller
        $sellerRole->givePermissionTo([
            'view products',
            'create products',
            'edit products',
            'delete products',
            'manage products',
            'view categories',
            'view orders',
            'update order status',
        ]);

        // Assigner les permissions de client au rôle client
        $clientRole->givePermissionTo([
            'view products',
            'view categories',
        ]);
    }
}
