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
        Schema::create('productos', function (Blueprint $table) {
            $table->integer('id_producto', true);
            $table->string('nom_producto', 45);
            $table->double('precio_unitario', null, 0);
            $table->integer('unidades_disponibles');
            $table->string('marca', 30);
            $table->integer('proveedor_id_proveedor')->index('fk_producto_proveedor1');
            $table->integer('categoria_producto')->index('fk_producto_categoria_producto1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
