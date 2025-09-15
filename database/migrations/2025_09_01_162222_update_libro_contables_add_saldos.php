<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('libro_contables', function (Blueprint $table) {
            // Eliminar la columna monto si ya no se usa
            if (Schema::hasColumn('libro_contables', 'monto')) {
                $table->dropColumn('monto');
            }

            // Agregar saldos
            $table->decimal('saldo_inicial', 15, 2)->default(0)->after('estado');
            $table->decimal('saldo_final', 15, 2)->default(0)->after('saldo_inicial');
        });
    }

    public function down(): void
    {
        Schema::table('libro_contables', function (Blueprint $table) {
            // Revertir cambios
            $table->decimal('monto', 15, 2)->nullable();

            $table->dropColumn('saldo_inicial');
            $table->dropColumn('saldo_final');
        });
    }
};
