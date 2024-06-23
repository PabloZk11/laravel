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
        Schema::table('devolucion', function (Blueprint $table) {
            $table->foreign(['id_producto'], 'devolucion_ibfk_1')->references(['id_producto'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_entrada_devolucion'], 'devolucion_ibfk_2')->references(['id_entrada'])->on('entrada_mercancias')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devolucion', function (Blueprint $table) {
            $table->dropForeign('devolucion_ibfk_1');
            $table->dropForeign('devolucion_ibfk_2');
        });
    }
};
