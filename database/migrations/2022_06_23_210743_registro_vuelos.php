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
            $table->integer('vuelo_id');
            $table->string('aerolinea_nombre');
            $table->string('pais_destino');
            $table->string('ciudad_destino');
            $table->float('latitud');
            $table->float('longitud');
            $table->string('nombre_pasajero');
            $table->string('apellido_pasajero');
            $table->string('genero');
            $table->timestamp('llegada');
            $table->string('fabricante_avion');
            $table->string('modelo_avion');
            $table->integer('capacidad');
            $table->timestamp('fecha_carga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
