<?php

namespace App\Http\Controllers;

use App\Models\Avion;
use App\Http\Requests\StoreAvionRequest;
use App\Http\Requests\UpdateAvionRequest;
use App\Models\Aerolinea;

class AvionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aviones = Avion::get();

        return view('aviones.index', ['aviones' => $aviones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aerolineas =  Aerolinea::all();
        return view('aviones.create', ['avion' => new Avion, 'aerolineas' => $aerolineas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAvionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAvionRequest $request)
    {
        $validated = $request->validated();

        Avion::create($validated);

        return redirect()->route('avion.index')
            ->with('message', 'Avion creado.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avion  $avion
     * @return \Illuminate\Http\Response
     */
    public function show(Avion $avion)
    {
        return view('aviones.show', compact('avion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Avion  $avion
     * @return \Illuminate\Http\Response
     */
    public function edit(Avion $avion)
    {
        $aerolineas =  Aerolinea::all();
        return view('aviones.edit', compact('avion', 'aerolineas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAvionRequest  $request
     * @param  \App\Models\Avion  $avion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAvionRequest $request, Avion $avion)
    {
        $validated = $request->validated();

        $avion->update($validated);

        return redirect()->route('avion.index')
            ->with('message', 'Avion editado.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avion  $avion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avion $avion)
    {
        try {
            $avion->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('avion.index')
                ->with('message', 'Peticion no puede ser procesada avion no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('avion.index')
            ->with('message', 'avion eliminado.')
            ->with('status', 'success');
    }

    public function search()
    {
        return redirect()->route('avion.index')
            ->with('title', 'Busqueda de avion')
            ->with('message', 'Use el buscador para encontrar un avion, o bien, registre un nuevo avion.')
            ->with('status', 'info');
    }
}
