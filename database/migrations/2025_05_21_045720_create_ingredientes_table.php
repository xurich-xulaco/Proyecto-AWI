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
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('cantidad', 10, 2);
            $table->string('unidad')->comment('g, kg, l, ml, oz, etc.');
            $table->decimal('nivel_alerta', 10, 2)->nullable()->comment('Minimal quantity before alert');
            $table->decimal('costo', 10, 2);
            $table->string('proveedor')->nullable();
            $table->date('fecha_caducidad')->nullable();
            $table->string('codigo')->nullable()->comment('SKU or barcode');
            $table->string('ubicacion')->nullable()->comment('Storage location');
            $table->timestamps();
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
