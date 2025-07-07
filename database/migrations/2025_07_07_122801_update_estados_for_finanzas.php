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
        Schema::table('estados', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estados', function (Blueprint $table) {
            //
        });
    }
};
Schema::table('estados', function (Blueprint $table) {
    $table->year('anio')->default(now()->year);
    $table->unsignedTinyInteger('mes');
    $table->decimal('saldo_inicial', 15, 2)->default(0);
    $table->decimal('entradas', 15, 2)->default(0);
    $table->decimal('salidas', 15, 2)->default(0);
    $table->decimal('saldo_final', 15, 2)->default(0);
});

