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
        Schema::create('entrada_mercancias', function (Blueprint $table) {
            $table->integer('id_entrada', true);
            $table->integer('cantidad_unidades');
            $table->integer('id_producto')->index('id_producto');
            $table->integer('id_pedido')->index('id_pedido');
            $table->integer('id_proveedor')->index('id_proveedor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_mercancias');
    }
};
