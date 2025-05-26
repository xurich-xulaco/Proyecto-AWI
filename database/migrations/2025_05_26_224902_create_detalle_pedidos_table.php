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
        Schema::create('detalle_pedidos', function (Blueprint $t) {
            $t->id('id_detalle');
            $t->foreignId('id_pedido')->constrained('pedidos','id_pedido')->onDelete('cascade');
            $t->foreignId('id_pizza')->constrained('pizzas','id_pizza')->onDelete('restrict');
            $t->integer('cantidad');
            $t->decimal('precio_unitario',10,2);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
