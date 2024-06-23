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
        Schema::table('pedido', function (Blueprint $table) {
            $table->foreign(['id_proveedor'], 'fk_pedido_proveedor1')->references(['id_proveedor'])->on('proveedors')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_admin'], 'fk_pedido_usuario1')->references(['id_usuario'])->on('usuario')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_producto'], 'pedido_ibfk_1')->references(['id_producto'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido', function (Blueprint $table) {
            $table->dropForeign('fk_pedido_proveedor1');
            $table->dropForeign('fk_pedido_usuario1');
            $table->dropForeign('pedido_ibfk_1');
        });
    }
};
