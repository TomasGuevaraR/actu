<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libro_contables', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('monto', 10, 2)->nullable();

            // Relación con estados
            $table->foreignId('estado_id')
                ->constrained('libro_contable_estados')
                ->cascadeOnUpdate()
                ->restrictOnDelete(); // evita borrar estados en uso

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libro_contables');
    }
};
