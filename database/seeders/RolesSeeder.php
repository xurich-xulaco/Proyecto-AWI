<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Rol::firstOrCreate(['nombre_rol' => 'cliente']);
        Rol::firstOrCreate(['nombre_rol' => 'chef']);
        Rol::firstOrCreate(['nombre_rol' => 'cajero']);
        Rol::firstOrCreate(['nombre_rol' => 'gerente']);
    }
}
