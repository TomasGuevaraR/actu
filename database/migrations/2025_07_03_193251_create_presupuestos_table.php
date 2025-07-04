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
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_casilla'); // Nombre de la casilla
            $table->enum('tipo', ['ingreso', 'egreso']); // Tipo de presupuesto
            $table->decimal('valor_mensual', 12, 2); // Valor mensual proyectado
            $table->year('año'); // Año de la proyección
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestos');
    }
};
