<?php

namespace App\Http\Controllers;

//use App\Models\Etl;
use App\Http\Requests\StoreAerolineaRequest;
use App\Http\Requests\UpdateAerolineaRequest;

use Marquine\Etl\Job;


class EtlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('etl.index');
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

        $ruta_archivo = public_path('csv/Libro2.csv');
        $table = 'ubicaciones';

        $jobs = new Job;

        $jobs->start()->extract('csv', $ruta_archivo, $options)
            ->load('table', $table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function create()
    {
        return view('aerolinea.create', ['aerolinea' => new Aerolinea]);
    }
*/
    /**
     * Store a newly created resource in storage.
     *  
     * @param  \App\Http\Requests\StoreAerolineaRequest  $request
     * @return \Illuminate\Http\Response
     */
/*
    public function store(StoreAerolineaRequest $request)
    {
        $validated = $request->validated();

        Aerolinea::create($validated);

        return redirect()->route('aerolinea.index');
    }
*/
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aerolinea  $aerolinea
     * @return \Illuminate\Http\Response
     */
/*
    public function show(Aerolinea $aerolinea)
    {
        return view('aerolinea.show', compact('aerolinea'));
    }
*/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aerolinea  $aerolinea
     * @return \Illuminate\Http\Response
     */
/*
    public function edit(Aerolinea $aerolinea)
    {
        return view('aerolinea.edit', compact('aerolinea'));
    }
*/
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAerolineaRequest  $request
     * @param  \App\Models\Aerolinea  $aerolinea
     * @return \Illuminate\Http\Response
     */
/*
    public function update(UpdateAerolineaRequest $request, Aerolinea $aerolinea)
    {
        $validated = $request->validated();

        $aerolinea->update($validated);

        return redirect()->route('aerolinea.index')
            ->with('message', 'Aerolinea editada.')
            ->with('status', 'success');
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aerolinea  $aerolinea
     * @return \Illuminate\Http\Response
     */
/*
    public function destroy(Aerolinea $aerolinea)
    {
        try {
            $aerolinea->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('aerolinea.index')
                ->with('message', 'Peticion no puede ser procesada aerolinea no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('aerolinea.index')
            ->with('message', 'Aerolinea eliminada.')
            ->with('status', 'success');
    }
*/
/*
    public function search()
    {
        return redirect()->route('aerolinea.index')
            ->with('title', 'Busqueda de aerolinea')
            ->with('message', 'Use el buscador para encontrar una aerolinea, o bien, registre una nueva aerolinea.')
            ->with('status', 'info');
    }
    */
}
