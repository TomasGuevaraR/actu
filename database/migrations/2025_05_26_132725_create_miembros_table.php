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
        Schema::create('miembros', function (Blueprint $table) {
        $table->id();
        $table->string('nombres');
        $table->string('apellidos');
        $table->string('numero_identificacion')->unique();
        $table->string('email')->nullable();
        $table->string('telefono')->nullable();
        $table->date('fecha_nacimiento')->nullable();
        $table->integer('edad')->nullable();
        $table->string('direccion')->nullable();
        $table->string('barrio')->nullable();
        $table->enum('estado', ['activo', 'inactivo', 'borrado', 'con excusa permanente', 'ausente'])->default('activo');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miembros');
    }
};
