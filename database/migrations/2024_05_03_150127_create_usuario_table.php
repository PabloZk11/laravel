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
        Schema::create('usuario', function (Blueprint $table) {
            $table->integer('id_usuario', true);
            $table->string('nombre', 45);
            $table->string('email', 45);
            $table->string('contraseña', 200);
            $table->integer('rol_usuario')->index('fk_usuario_roles');
            $table->integer('tdoc_usuario')->index('fk_usuario_documento_identificacion1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
