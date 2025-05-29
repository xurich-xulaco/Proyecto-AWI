<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'notificaciones';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists($this->table);
        Schema::enableForeignKeyConstraints();

        Schema::create('notificaciones', function (Blueprint $t) {
            $t->id('id_notificacion');
            $t->foreignId('id_usuario')->constrained('users','id_usuario')->onDelete('cascade');
            $t->string('titulo',100);
            $t->text('mensaje');
            $t->boolean('leido')->default(false);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('notificaciones');
        Schema::enableForeignKeyConstraints();
    }
};
