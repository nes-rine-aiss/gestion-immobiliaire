<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // -----------------------------------------
        // Appeler d'abord le seeder des rôles et permissions
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Créer des utilisateurs de test avec des rôles
        $this->createTestUsers();
    }
         private function createTestUsers()
         {
        // Créer SuperAdmin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('superadmin');

        // Créer Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Créer Propriétaire
        $proprietaire = User::create([
            'name' => 'Propriétaire Test',
            'email' => 'proprietaire@test.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $proprietaire->assignRole('proprietaire');

        // Créer Locataire
        $locataire = User::create([
            'name' => 'Locataire Test',
            'email' => 'locataire@test.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $locataire->assignRole('locataire');

        echo "Utilisateurs de test créés:\n";
        echo "- SuperAdmin: superadmin@test.com / password123\n";
        echo "- Admin: admin@test.com / password123\n";
        echo "- Propriétaire: proprietaire@test.com / password123\n";
        echo "- Locataire: locataire@test.com / password123\n";
        }
}
