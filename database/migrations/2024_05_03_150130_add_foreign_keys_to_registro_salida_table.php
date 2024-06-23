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
        Schema::table('registro_salida', function (Blueprint $table) {
            $table->foreign(['id_factura_salida'], 'fk_registro_salida_factura_salida1')->references(['Id_factura_salida'])->on('factura_salida')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_producto'], 'fk_registro_salida_producto1')->references(['id_producto'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_salida', function (Blueprint $table) {
            $table->dropForeign('fk_registro_salida_factura_salida1');
            $table->dropForeign('fk_registro_salida_producto1');
        });
    }
};
