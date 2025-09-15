<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('libro_contables', function (Blueprint $table) {
        $table->boolean('aprobado_pastor')->default(false);
        $table->boolean('aprobado_fiscal')->default(false);
    });
}

public function down()
{
    Schema::table('libro_contables', function (Blueprint $table) {
        $table->dropColumn(['aprobado_pastor', 'aprobado_fiscal']);
    });
}

};
