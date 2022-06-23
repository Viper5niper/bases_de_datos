<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistroVuelos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_vuelos', function (Blueprint $table) {
            // $table->id();
            $table->id();
            $table->integer('vuelo_id')->nullable();
            $table->string('nombre_aerolinea')->nullable();
            $table->string('pais_destino')->nullable();
            $table->string('ciudad_destino')->nullable();
            $table->float('latitud')->nullable();
            $table->float('longitud')->nullable();
            $table->string('pais_origen')->nullable();
            $table->string('ciudad_origen')->nullable();
            $table->string('nombre_pasajero')->nullable();
            $table->string('apellido_pasajero')->nullable();
            $table->string('genero')->nullable();
            $table->timestamp('llegada')->nullable();
            $table->string('fabricante_avion')->nullable();
            $table->string('modelo_avion')->nullable();
            $table->integer('capacidad')->nullable();
            $table->timestamp('fecha_carga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('registro_vuelos');
    }
}
