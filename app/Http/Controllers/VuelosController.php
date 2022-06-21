<?php

namespace App\Http\Controllers;

use App\Models\Vuelo;
use App\Http\Requests\StoreVueloRequest;
use App\Http\Requests\UpdateVueloRequest;
use App\Models\Avion;
use App\Models\Ubicacion;

class VuelosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vuelos = Vuelo::get();

        return view('vuelos.index', ['vuelos' => $vuelos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ubicaciones =  Ubicacion::all();
        $aviones = Avion::all();
        return view('vuelos.create', ['vuelo' => new Vuelo, 'ubicaciones' => $ubicaciones, 'aviones' => $aviones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVueloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVueloRequest $request)
    {
        $validated = $request->validated();

        Vuelo::create($validated);

        return redirect()->route('vuelo.index')
            ->with('message', 'Vuelo creado.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function show(Vuelo $vuelo)
    {
        return view('vuelos.show', compact('vuelo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vuelo $vuelo)
    {
        $ubicaciones =  Ubicacion::all();
        $aviones = Avion::all();
        return view('vuelos.edit', compact('vuelo', 'ubicaciones', 'aviones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVueloRequest  $request
     * @param  \App\Models\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVueloRequest $request, Vuelo $vuelo)
    {
        $validated = $request->validated();

        $vuelo->update($validated);

        return redirect()->route('vuelo.index')
            ->with('message', 'Vuelo editado.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vuelo $vuelo)
    {
        try {
            $vuelo->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('vuelo.index')
                ->with('message', 'Peticion no puede ser procesada vuelo no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('vuelo.index')
            ->with('message', 'vuelo eliminado.')
            ->with('status', 'success');
    }

    public function search()
    {
        return redirect()->route('vuelo.index')
            ->with('title', 'Busqueda de vuelo')
            ->with('message', 'Use el buscador para encontrar un vuelo, o bien, registre un nuevo vuelo.')
            ->with('status', 'info');
    }
}
