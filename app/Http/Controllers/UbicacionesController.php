<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Http\Requests\StoreUbicacionRequest;
use App\Http\Requests\UpdateUbicacionRequest;
//use App\Models\OrdenTrabajo;

class UbicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ubicaciones = Ubicacion::get();

        return view('ubicaciones.index', ['ubicaciones' => $ubicaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ubicaciones.create', ['ubicacion' => new Ubicacion]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUbicacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUbicacionRequest $request)
    {
        $validated = $request->validated();

        Ubicacion::create($validated);

        return redirect()->route('ubicacion.index')
            ->with('message', 'Ubicacion creada.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ubicacion $ubicacion)
    {
        return view('ubicaciones.show', compact('ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        return view('ubicaciones.edit', compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUbicacionRequest  $request
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUbicacionRequest $request, Ubicacion $ubicacion)
    {
        $validated = $request->validated();

        $ubicacion->update($validated);

        return redirect()->route('ubicacion.index')
            ->with('message', 'Ubicacion editada.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        try {
            $ubicacion->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('ubicacion.index')
                ->with('message', 'Peticion no puede ser procesada la ubicacion no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('ubicacion.index')
            ->with('message', 'ubicacion eliminada.')
            ->with('status', 'success');
    }

    public function search()
    {
        return redirect()->route('ubicacion.index')
            ->with('title', 'Busqueda de Ubicacion')
            ->with('message', 'Use el buscador para encontrar una ubicacion, o bien, registre una nueva ubicacion.')
            ->with('status', 'info');
    }
}
