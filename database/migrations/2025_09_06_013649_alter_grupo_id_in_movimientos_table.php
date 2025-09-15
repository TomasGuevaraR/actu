<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            // Convertimos grupo_id a string(50)
            $table->string('grupo_id', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            // Revertir a bigInteger
            $table->bigInteger('grupo_id')->nullable()->change();
        });
    }
};
