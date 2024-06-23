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
        Schema::create('devolucion', function (Blueprint $table) {
            $table->integer('id_devolucion', true);
            $table->integer('id_producto')->index('id_producto');
            $table->integer('unidades');
            $table->integer('id_entrada_devolucion')->index('id_entrada_devolucion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devolucion');
    }
};
