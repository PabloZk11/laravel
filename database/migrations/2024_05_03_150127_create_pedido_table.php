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
        Schema::create('pedido', function (Blueprint $table) {
            $table->integer('id_pedido', true);
            $table->integer('unidades');
            $table->integer('id_producto')->index('id_producto');
            $table->integer('id_admin')->index('fk_pedido_usuario1');
            $table->integer('id_proveedor')->index('fk_pedido_proveedor1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
