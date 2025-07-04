<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('numero_identificacion')->unique();
            $table->string('email')->unique();
            $table->string('alias')->unique();
            $table->string('password');
            $table->enum('rol', ['pastor', 'anciano', 'tesorero', 'fiscal', 'secretario']);
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('usuarios');
    }
};
