<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            // Agregamos solo los que no existen
            if (!Schema::hasColumn('movimientos', 'detalle')) {
                $table->string('detalle')->nullable()->after('descripcion');
            }

            if (!Schema::hasColumn('movimientos', 'concepto')) {
                $table->string('concepto')->nullable()->after('detalle');
            }

            if (!Schema::hasColumn('movimientos', 'casilla')) {
                $table->string('casilla')->nullable()->after('concepto');
            }

            if (!Schema::hasColumn('movimientos', 'saldo')) {
                $table->decimal('saldo', 15, 2)->nullable()->after('valor');
            }
        });
    }

    public function down()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropColumn(['detalle', 'concepto', 'casilla', 'saldo']);
        });
    }
};
