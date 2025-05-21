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
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('ingrediente_id')->constrained('ingredientes');
            $table->decimal('cantidad', 10, 2)->comment('Amount of ingredient needed');
            $table->string('unidad')->nullable();
            $table->text('notas')->nullable();
            $table->boolean('opcional')->default(false);
            $table->timestamps();
            
            // Unique constraint to prevent duplicate ingredients for a product
            $table->unique(['producto_id', 'ingrediente_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};
