<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->dropColumn('tipo'); // elimina el campo tipo
            $table->string('categoria')->after('nombre_casilla'); // agrega el nuevo campo
        });
    }

    public function down(): void
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->dropColumn('categoria');
        });
    }
};
