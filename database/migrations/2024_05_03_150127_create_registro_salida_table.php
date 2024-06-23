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
        Schema::create('registro_salida', function (Blueprint $table) {
            $table->integer('id_salida')->primary();
            $table->integer('unidades');
            $table->integer('id_factura_salida')->index('fk_registro_salida_factura_salida1');
            $table->integer('id_producto')->index('fk_registro_salida_producto1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_salida');
    }
};
