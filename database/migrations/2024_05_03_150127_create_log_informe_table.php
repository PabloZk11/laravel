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
        Schema::create('log_informe', function (Blueprint $table) {
            $table->integer('id_informe')->primary();
            $table->dateTime('fecha_creacion');
            $table->string('detalles_informe', 45);
            $table->integer('id_vendedor')->index('id_vendedor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_informe');
    }
};
