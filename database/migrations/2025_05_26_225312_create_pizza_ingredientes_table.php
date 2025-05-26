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
        Schema::create('pizza_ingredientes', function (Blueprint $t) {
            $t->foreignId('id_pizza')->constrained('pizzas','id_pizza')->onDelete('cascade');
            $t->foreignId('id_ingrediente')->constrained('ingredientes','id_ingrediente')->onDelete('cascade');
            $t->integer('cantidad_ingrediente');
            $t->primary(['id_pizza','id_ingrediente']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_ingredientes');
    }
};
