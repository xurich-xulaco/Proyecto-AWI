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
        Schema::create('ingredientes', function (Blueprint $t) {
            $t->id('id_ingrediente');
            $t->string('nombre', 100);
            $t->text('descripcion')->nullable();
            $t->integer('stock')->default(0)->index();
            $t->decimal('precio_unitario', 10, 2);
            $t->softDeletes();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredientes');
    }
};
