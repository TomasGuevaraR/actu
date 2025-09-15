<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('egresos', function (Blueprint $table) {
            $table->string('detalle')->nullable()->after('valor');
            $table->string('concepto')->nullable()->after('detalle');
        });
    }

    public function down()
    {
        Schema::table('egresos', function (Blueprint $table) {
            $table->dropColumn(['detalle', 'concepto']);
        });
    }
};
