<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les permissions
        $permissions = [
            // Permissions générales
            'view_dashboard',
            'manage_profile',
            
            // Permissions SuperAdmin
            'manage_all_users',
            'manage_all_properties',
            'manage_system_settings',
            'view_all_reports',
            'delete_any_user',
            'assign_roles',
            
            // Permissions Admin
            'manage_users',
            'manage_properties',
            'view_reports',
            'create_users',
            'edit_users',
            
            // Permissions Propriétaire
            'manage_own_properties',
            'add_properties',
            'edit_own_properties',
            'delete_own_properties',
            'manage_tenants',
            'view_property_reports',
            'manage_contracts',
            
            // Permissions Locataire
            'view_own_property',
            'view_own_contract',
            'submit_maintenance_requests',
            'view_payment_history',
            'update_own_profile'
        ];

        // Créer toutes les permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Créer les rôles et assigner les permissions

        // 1. SuperAdmin - toutes les permissions
        $superAdmin = Role::create(['name' => 'superadmin']);
        $superAdmin->givePermissionTo(Permission::all());

        // 2. Admin - permissions d'administration
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view_dashboard',
            'manage_profile',
            'manage_users',
            'manage_properties',
            'view_reports',
            'create_users',
            'edit_users'
        ]);

        // 3. Propriétaire - gestion de ses propriétés
        $proprietaire = Role::create(['name' => 'proprietaire']);
        $proprietaire->givePermissionTo([
            'view_dashboard',
            'manage_profile',
            'manage_own_properties',
            'add_properties',
            'edit_own_properties',
            'delete_own_properties',
            'manage_tenants',
            'view_property_reports',
            'manage_contracts'
        ]);

        // 4. Locataire - accès limité
        $locataire = Role::create(['name' => 'locataire']);
        $locataire->givePermissionTo([
            'view_dashboard',
            'manage_profile',
            'view_own_property',
            'view_own_contract',
            'submit_maintenance_requests',
            'view_payment_history',
            'update_own_profile'
        ]);

        echo "Rôles et permissions créés avec succès!\n";
        echo "Rôles créés: superadmin, admin, proprietaire, locataire\n";
        echo "Total permissions: " . count($permissions) . "\n";
    }
}
