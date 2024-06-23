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
        Schema::table('entrada_mercancias', function (Blueprint $table) {
            $table->foreign(['id_producto'], 'entrada_mercancias_ibfk_1')->references(['id_producto'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_pedido'], 'entrada_mercancias_ibfk_2')->references(['id_pedido'])->on('pedido')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_proveedor'], 'entrada_mercancias_ibfk_3')->references(['id_proveedor'])->on('proveedors')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrada_mercancias', function (Blueprint $table) {
            $table->dropForeign('entrada_mercancias_ibfk_1');
            $table->dropForeign('entrada_mercancias_ibfk_2');
            $table->dropForeign('entrada_mercancias_ibfk_3');
        });
    }
};
