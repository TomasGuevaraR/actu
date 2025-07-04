<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('presupuesto_id'); // Relación con presupuesto
            $table->date('fecha');
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->decimal('valor', 12, 2);
            $table->text('descripcion')->nullable();
            $table->timestamps();

            // Clave foránea
            $table->foreign('presupuesto_id')->references('id')->on('presupuestos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
