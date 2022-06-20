<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use App\Http\Requests\StorePasajeroRequest;
//use App\Http\Requests\UpdatePasajeroRequest;
class PasajerosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasajeros = Pasajero::get();
        return view('pasajeros.index', ['pasajero' => $pasajeros]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pasajeros.create', ['pasajero' => new Pasajero]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePasajeroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePasajeroRequest $request)
    {
        $validated = $request->validated();

        Pasajero::create($validated);

        return redirect()->route('pasajeros.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function show(Pasajero $pasajero)
    {
        return view('pasajeros.show', compact('pasajero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasajero $pasajero)
    {
        return view('pasajeros.edit', compact('pasajero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePasajeroRequest  $request
     * @param  \App\Models\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePasajeroRequest $request, Pasajero $pasajero)
    {
        $validated = $request->validated();

        $pasajero->update($validated);

        return redirect()->route('pasajeros.index')
            ->with('message', 'Pasajero editado.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasajero $pasajero)
    {
        try {
            $pasajero->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('pasajeros.index')
                ->with('message', 'Peticion no puede ser procesada, el pasajero no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('pasajeros.index')
            ->with('message', 'Pasajero eliminado.')
            ->with('status', 'success');
    }

    public function search()
    {
        return redirect()->route('pasajeros.index')
            ->with('title', 'Busqueda de cliente')
            ->with('message', 'Use el buscador para encontrar a un pasajero, o bien, registre una nuevo pasajero.')
            ->with('status', 'info');
    }
}
