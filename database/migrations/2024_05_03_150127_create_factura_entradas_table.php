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
        Schema::create('factura_entradas', function (Blueprint $table) {
            $table->integer('id_factura_entrada', true);
            $table->bigInteger('unidades');
            $table->float('precio_unitario', null, 0);
            $table->float('precio_total', null, 0);
            $table->dateTime('fecha');
            $table->integer('id_proveedor')->index('fk_factura_entrada_proveedor1');
            $table->integer('producto_id_producto')->index('fk_factura_entrada_producto1');

            $table->primary(['id_factura_entrada', 'id_proveedor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_entradas');
    }
};
