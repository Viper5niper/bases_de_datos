<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Marquine\Etl\Job;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('ordenestrabajo.index');
    }

    public function etl(){

    $query = ' SELECT vu.id AS vuelo_id, ae.nombre AS nombre_aerolinea, ori.pais AS pais_origen,  
    des.pais AS pais_destino, des.ciudad AS ciudad_destino, 
    av.fabricante AS fabricante_avion, av.modelo AS modelo_avion, av.capacidad AS capacidad, 
    pa.nombre AS nombre_pasajero, pa.apellido AS apellido_pasajero, pa.genero AS genero,
    bo.llegada AS llegada
    FROM vuelos vu 
    INNER JOIN ubicaciones ori ON ori.id = vu.origen_id
    INNER JOIN ubicaciones des ON des.id = vu.destino_id
    INNER JOIN aviones av ON av.id = vu.avion_id
    INNER JOIN boleto bo ON bo.vuelo_id = vu.id
    INNER JOIN pasajeros pa ON pa.id = bo.pasajero_id
    INNER JOIN aerolineas ae ON ae.id = av.aerolinea_id
    ';

    $options = [

    ];


    Job::start()->extract('query', $query)
    ->transform('trim', ['columns' => ['nombre_aerolinea', 'nombre_aerolinea']])
    ->load('table', 'registro_vuelos');

    }
}
