<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Asegúrate de importar el modelo User
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear roles con guard 'web'
        $doctorRole = Role::create(['name' => 'doctor', 'guard_name' => 'web']);
        $patientRole = Role::create(['name' => 'patient', 'guard_name' => 'web']);

        // Crear permisos básicos
        Permission::create(['name' => 'view doctors', 'guard_name' => 'web']);
        Permission::create(['name' => 'view patients', 'guard_name' => 'web']);
        Permission::create(['name' => 'view profile', 'guard_name' => 'web']);

        // Asignar permisos a roles
        $doctorRole->givePermissionTo(['view doctors', 'view patients', 'view profile']);
        $patientRole->givePermissionTo('view patients');

        // Crear usuario y asignar rol
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'registered' => true,
            'role' => 'doctor',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Test2 User2',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'),
            'registered' => true,
            'role' => 'patient',
        ]);


        // Asignar el rol 'patient' al usuario creado
        $user->assignRole('doctor');
        $user2->assignRole('patient');
    }
}
