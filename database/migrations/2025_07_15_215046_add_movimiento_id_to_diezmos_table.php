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
        Schema::table('diezmos', function (Blueprint $table) {
        $table->foreignId('movimiento_id')
              ->nullable()                // por si ya tienes datos antiguos
                ->constrained('movimientos')
              ->onDelete('cascade');      // ← BORRA en cascada
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diezmos', function (Blueprint $table) {
            //
        });
    }
};
