<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            if (Schema::hasColumn('movimientos', 'descripcion')) {
                $table->dropColumn('descripcion');
            }
        });
    }

    public function down()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->string('descripcion')->nullable();
        });
    }
};
