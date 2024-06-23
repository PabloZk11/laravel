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
        Schema::table('factura_salida', function (Blueprint $table) {
            $table->foreign(['id_producto'], 'factura_salida_ibfk_1')->references(['id_producto'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_vendedor'], 'factura_salida_ibfk_2')->references(['id_usuario'])->on('usuario')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_producto'], 'factura_salida_ibfk_3')->references(['id_producto'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factura_salida', function (Blueprint $table) {
            $table->dropForeign('factura_salida_ibfk_1');
            $table->dropForeign('factura_salida_ibfk_2');
            $table->dropForeign('factura_salida_ibfk_3');
        });
    }
};
