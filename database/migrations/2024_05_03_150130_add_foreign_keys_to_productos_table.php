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
        Schema::table('productos', function (Blueprint $table) {
            $table->foreign(['categoria_producto'], 'fk_producto_categoria_producto1')->references(['id_categoria'])->on('categoria_productos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['proveedor_id_proveedor'], 'fk_producto_proveedor1')->references(['id_proveedor'])->on('proveedors')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign('fk_producto_categoria_producto1');
            $table->dropForeign('fk_producto_proveedor1');
        });
    }
};
