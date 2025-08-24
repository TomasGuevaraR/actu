<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('movimientos', function (Blueprint $table) {
        $table->foreignId('libro_contable_id')->nullable()->constrained('libros_contables')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('movimientos', function (Blueprint $table) {
        $table->dropForeign(['libro_contable_id']);
        $table->dropColumn('libro_contable_id');
    });
}

};
