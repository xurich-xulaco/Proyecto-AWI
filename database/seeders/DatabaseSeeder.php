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
        // Limpieza opcional (si quieres forzar fresh):
        // \App\Models\User::truncate();

         // Creación de roles
        $this->call(\Database\Seeders\RolesSeeder::class);
        // Usuario de prueba
        User::updateOrCreate(
            ['email' => 'proyectoweb047@gmail.com'],
            [
                'name'              => 'Admin',
                'password'          => bcrypt('secret'),
                // Aquí USAMOS el enum 'rol', no 'role_id' ni 'id_rol'
                'rol'               => 'gerente',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info("Usuario admin creado/actualizado con ID {$user->id}");
    }
}
