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
        Schema::table('log_informe', function (Blueprint $table) {
            $table->foreign(['id_vendedor'], 'log_informe_ibfk_1')->references(['id_usuario'])->on('usuario')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_informe', function (Blueprint $table) {
            $table->dropForeign('log_informe_ibfk_1');
        });
    }
};
