<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Role;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Si existe id_rol, primero eliminamos su FK y luego la columna
            if (Schema::hasColumn('users', 'id_rol')) {
                // elimina la constraint foreign key
                $table->dropForeign(['id_rol']);
                // ahora sí, elimina la columna
                $table->dropColumn('id_rol');
            }
            // Añadimos rol como ENUM y por defecto cliente
            $table->enum('rol', array_map(fn($c) => $c->value, Role::cases()))
                  ->default(Role::CLIENTE->value)
                  ->after('password');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
            // (Opcional) Si quieres restaurar id_rol, añade aquí el schema
        });
    }
};
