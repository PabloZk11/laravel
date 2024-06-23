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
        Schema::table('factura_entradas', function (Blueprint $table) {
            $table->foreign(['producto_id_producto'], 'fk_factura_entrada_producto1')->references(['id_producto'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_proveedor'], 'fk_factura_entrada_proveedor1')->references(['id_proveedor'])->on('proveedors')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factura_entradas', function (Blueprint $table) {
            $table->dropForeign('fk_factura_entrada_producto1');
            $table->dropForeign('fk_factura_entrada_proveedor1');
        });
    }
};
