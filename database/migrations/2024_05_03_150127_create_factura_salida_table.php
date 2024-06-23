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
        Schema::create('factura_salida', function (Blueprint $table) {
            $table->integer('Id_factura_salida', true);
            $table->bigInteger('Cantidad');
            $table->double('Precio_unitario', null, 0);
            $table->double('Precio_total', null, 0);
            $table->dateTime('Fecha');
            $table->integer('id_producto')->index('id_producto');
            $table->integer('id_vendedor')->index('id_vendedor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_salida');
    }
};
