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
            $table->year('anio')->default(date('Y'))->after('id');
            $table->unsignedTinyInteger('mes')->default(1)->after('anio');
            $table->decimal('saldo_inicial', 15, 2)->default(0)->after('mes');
            $table->decimal('entradas', 15, 2)->default(0)->after('saldo_inicial');
            $table->decimal('salidas', 15, 2)->default(0)->after('entradas');
            $table->decimal('saldo_final', 15, 2)->default(0)->after('salidas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estados', function (Blueprint $table) {
            $table->dropColumn([
                'anio',
                'mes',
                'saldo_inicial',
                'entradas',
                'salidas',
                'saldo_final'
            ]);
        });
    }
};
