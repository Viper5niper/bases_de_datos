<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vuelo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            // $table->id();
            $table->integer('vuelo_id')->unsigned();
            $table->integer('origen_id');
            $table->integer('destino_id');
            $table->integer('avion_id');
            $table->datetime('despegue');
            $table->datetime('aterrizaje');
            $table->float('precio');
            $table->float('recorrido');
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
        Schema::drop('vuelos');
    }
}
