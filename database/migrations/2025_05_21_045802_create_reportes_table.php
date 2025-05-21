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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->enum('tipo', ['ventas', 'inventario', 'financiero', 'empleados', 'clientes', 'personalizado'])->default('ventas');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->json('datos')->nullable();
            $table->foreignId('generado_por')->constrained('users');
            $table->enum('formato', ['pdf', 'excel', 'csv'])->default('pdf');
            $table->string('archivo_url')->nullable();
            $table->text('notas')->nullable();
            $table->boolean('programado')->default(false);
            $table->json('criterios')->nullable()->comment('Filter criteria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
