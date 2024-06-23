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
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign(['tdoc_usuario'], 'fk_usuario_documento_identificacion1')->references(['id_documento'])->on('documento_identificacion')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['rol_usuario'], 'fk_usuario_roles')->references(['id_rol'])->on('roles')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('fk_usuario_documento_identificacion1');
            $table->dropForeign('fk_usuario_roles');
        });
    }
};
