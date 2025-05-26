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
        Schema::create('reporte_logs', function (Blueprint $t) {
            $t->id('id_reporte');
            $t->date('fecha_reporte');
            $t->enum('tipo_reporte',['diario','mensual','financiero']);
            $t->string('ruta_archivo',255);
            $t->foreignId('id_generador')->nullable()->constrained('users','id_usuario')->nullOnDelete();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_logs');
    }
};
