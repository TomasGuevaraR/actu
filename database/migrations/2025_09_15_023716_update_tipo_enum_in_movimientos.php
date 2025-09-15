<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Modificamos el ENUM para aceptar 'saldo_inicial'
        DB::statement("ALTER TABLE movimientos 
            MODIFY tipo ENUM('ingreso','egreso','saldo_inicial') NOT NULL
            COMMENT 'Tipo de movimiento: ingreso, egreso o saldo inicial'");
    }

    public function down(): void
    {
        // Revertimos a los valores originales
        DB::statement("ALTER TABLE movimientos 
            MODIFY tipo ENUM('ingreso','egreso') NOT NULL
            COMMENT 'Tipo de movimiento: ingreso o egreso'");
    }
};
