<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pasajero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasajeros', function (Blueprint $table) {
            // $table->id();
            $table->integer('pasajero_id')->unsigned();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('genero');
            $table->integer('ubicacion_id');
            $table->datetime('fecha_nacimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pasajeros');
    }
}
