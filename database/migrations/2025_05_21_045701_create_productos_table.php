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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('imagen')->nullable();
            $table->boolean('disponible')->default(true);
            $table->text('opciones')->nullable()->comment('JSON string with options like sizes, toppings, etc.');
            $table->decimal('precio_costo', 10, 2)->nullable();
            $table->decimal('descuento', 10, 2)->default(0);
            $table->json('nutricion')->nullable()->comment('Nutritional information');
            $table->boolean('destacado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
