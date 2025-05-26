<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pizzas', function (Blueprint $t) {
            $t->id('id_pizza');
            $t->string('nombre', 100);
            $t->text('descripcion')->nullable();
            $t->decimal('precio', 10, 2);
            $t->enum('estado',['activo','inactivo'])->default('activo');
            $t->softDeletes();
            $t->timestamps();
            $t->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizzas');
    }
};
