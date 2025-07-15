<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiezmosTable extends Migration
{
    public function up()
    {
        Schema::create('diezmos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');    // Nombre del miembro
            $table->integer('valor');    // Valor del diezmo
            $table->date('fecha');       // Fecha del diezmo
            $table->timestamps();        // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('diezmos');
    }
}
