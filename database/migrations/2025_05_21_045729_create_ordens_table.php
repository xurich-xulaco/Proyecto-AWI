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
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->string('numero_orden')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('estado', ['pendiente', 'en_preparacion', 'listo', 'entregado', 'cancelado'])->default('pendiente');
            $table->enum('tipo_orden', ['local', 'para_llevar', 'delivery'])->default('local');
            $table->string('direccion_entrega')->nullable();
            $table->text('notas')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('impuestos', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('costo_envio', 10, 2)->default(0);
            $table->decimal('propina', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('metodo_pago', ['efectivo', 'tarjeta', 'transferencia', 'otro'])->default('efectivo');
            $table->string('referencia_pago')->nullable();
            $table->boolean('pagado')->default(false);
            $table->foreignId('cajero_id')->nullable()->constrained('users');
            $table->foreignId('cocinero_id')->nullable()->constrained('users');
            $table->foreignId('repartidor_id')->nullable()->constrained('users');
            $table->timestamp('hora_preparacion')->nullable();
            $table->timestamp('hora_listo')->nullable();
            $table->timestamp('hora_entrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens');
    }
};
