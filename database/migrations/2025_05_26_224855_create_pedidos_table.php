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
        Schema::create('pedidos', function (Blueprint $t) {
            $t->id('id_pedido');
            $t->foreignId('id_cliente')->constrained('users','id_usuario')->onDelete('cascade');
            $t->decimal('total_amount',10,2);
            $t->enum('estado',['pendiente','en_proceso','listo','entregado','cancelado'])
            ->default('pendiente')->index();
            $t->string('direccion_entrega')->nullable();
            $t->string('metodo_pago',50)->nullable();
            $t->softDeletes();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
