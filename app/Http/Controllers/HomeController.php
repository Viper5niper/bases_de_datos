<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Marquine\Etl\Job;

use DB;

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
        return redirect()->route('aerolinea.index');
    }

    public function etl()
    {

        $query = ' SELECT vu.id AS vuelo_id, ae.nombre AS nombre_aerolinea, 
        des.pais AS pais_destino, des.ciudad AS ciudad_destino, des.latitud AS latitud, 
        des.longitud AS longitud, ori.pais AS pais_origen,  
        pa.nombre AS nombre_pasajero, pa.apellido AS apellido_pasajero, pa.genero AS genero,
        bo.llegada AS llegada, av.fabricante AS fabricante_avion, av.modelo AS modelo_avion, 
        av.capacidad AS capacidad, current_date AS fecha_carga
        FROM vuelos vu 
        INNER JOIN ubicaciones ori ON ori.id = vu.origen_id
        INNER JOIN ubicaciones des ON des.id = vu.destino_id
        INNER JOIN aviones av ON av.id = vu.avion_id
        LEFT JOIN boleto bo ON bo.vuelo_id = vu.id
        INNER JOIN pasajeros pa ON pa.id = bo.pasajero_id
        INNER JOIN aerolineas ae ON ae.id = av.aerolinea_id';

        $options = [
            'columns' => [
                'vuelo_id'  => 1, 'nombre_aerolinea'  => 2, 'pais_destino'  => 3, 'ciudad_destino'  => 4,
                'latitud'  => 5, 'longitud' => 6, 'pais_origen' => 7, 'nombre_pasajero' => 8, 'apellido_pasajero' => 9,
                'genero' => 10, 'llegada' => 11, 'fabricante_avion'  => 12, 'modelo_avion'  => 13, 'capacidad'  => 14,
                'fecha_carga' => 15
            ]
        ];

        Job::start()->extract('query', $query)
            //->transform('trim', ['columns' => ['nombre_aerolinea']])
            ->load('table', 'registro_vuelos');
    }

    public function etl_base()
    {
        $options = [
            'columns' => [
                'pais' => 1,
                'ciudad' => 2,
                'latitud' => 3,
                'longitud' => 4
            ]
        ];

        $ruta_archivo = 'C:\Users\PC\Downloads\Libro2.csv';
        $table = 'ubicaciones';

        $jobs = new Job;

        $jobs->start()->extract('csv', $ruta_archivo, $options)
            ->load('table', $table);
    }
}
