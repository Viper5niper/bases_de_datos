<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('vin_vehiculo')->nullable();
            $table->string('placa_vehiculo')->nullable();
            $table->text('propietario_vehiculo')->nullable();
            $table->string('marca_vehiculo')->nullable();
            $table->string('modelo_vehiculo')->nullable();
            $table->integer('anio_vehiculo')->nullable();
            $table->integer('kilometraje_vehiculo')->nullable();
            $table->string('unidad_vehiculo')->nullable()->default('Km');  //Millas o Kilometros ("Mi", "Km")
            //dar la opcion de guardar en millas o km, si elige millas convertir a km
            $table->text('cliente_id');
            $table->string('tecnico_encargado')->nullable();
            $table->longText('descripcion_servicio')->nullable();
            $table->longText('detalle_servicio');   //sera llenado con un JSON
            $table->float('monto_servicio')->nullable();
            $table->float('cancelado_servicio')->nullable();
            $table->boolean('pagado')->nullable()->default(false);
            $table->text('observacion_servicio')->nullable();
            $table->text('trabajo_realizado')->nullable();
            $table->timestamp('fecha_entrada')->nullable();
            $table->timestamp('fecha_salida')->nullable();
            $table->timestamp('proximo_servicio')->nullable();
            $table->boolean('contactado')->default(false);
            $table->boolean('cotizacion')->default(false);
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
        Schema::dropIfExists('orden_trabajos');
    }
}

/*
TODO: IMPORTANTE LEER
EJemplo de objeto json de "detalle_servicio"
Aconsejo lo siguiente: como esto sera la parte de descripcion, debes tener en cuenta la orden de ejemplo, pueden ir piezas
por lo que seria ideal que metieras cantidad o bueno especifica que en la descripcion se pondra esto
[
    {
        "descripcion" : "filtro de aire",
        "origen" : "tercero",    //este item fue adquirido a una empresa ajena
        "costo" : 150
    },
    {
        "descripcion" : "aceite de transmision",
        "origen" : "propio",    //este item fue brindado por nuestra empresa
        "costo" : 150
    },
    {
        "descripcion" : "cambio de aceite",
        "origen" : "manodeobra",    //este item fue brindado por el personal de la empresa
        "costo" : 150
    },
]

*/

