<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libro_contable_estados', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT
            $table->string('nombre')->unique(); // Ej: Abierto, Cerrado, Aprobado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libro_contable_estados');
    }
};
