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
        if (!Schema::hasTable('egresos')) {
            Schema::create('egresos', function (Blueprint $table) {
                $table->id();
                $table->date('fecha');
                $table->decimal('valor', 15, 2);

                // Nuevas columnas
                $table->string('detalle')->nullable();
                $table->string('concepto')->nullable();

                $table->unsignedBigInteger('presupuesto_id');
                $table->unsignedBigInteger('movimiento_id');
                $table->timestamps();

                // Llaves foráneas
                $table->foreign('presupuesto_id')
                    ->references('id')->on('presupuestos')
                    ->onDelete('cascade');

                $table->foreign('movimiento_id')
                    ->references('id')->on('movimientos')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresos');
    }
};
