<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Http\Requests\StoreBoletoRequest;
use App\Http\Requests\UpdateBoletoRequest;
use App\Models\Pasajero;
use App\Models\Vuelo;

class BoletosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boletos = Boleto::get();

        return view('boletos.index', ['boletos' => $boletos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pasajeros =  Pasajero::all();
        $vuelos = Vuelo::all();
        
        return view('boletos.create', ['boleto' => new Boleto, 'pasajeros' => $pasajeros, 'vuelos' => $vuelos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoletoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoletoRequest $request)
    {
        $validated = $request->validated();

        Boleto::create($validated);

        return redirect()->route('boleto.index')
            ->with('message', 'Boleto creado.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Boleto  $boleto
     * @return \Illuminate\Http\Response
     */
    public function show(Boleto $boleto)
    {
        return view('boletos.show', compact('boleto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Boleto  $boleto
     * @return \Illuminate\Http\Response
     */
    public function edit(Boleto $boleto)
    {
        $pasajeros =  Pasajero::all();
        $vuelos = Vuelo::all();

        return view('boleto.edit', compact('boleto', 'pasajeros', 'vuelos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoletoRequest  $request
     * @param  \App\Models\Boleto  $boleto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoletoRequest $request, Boleto $boleto)
    {
        $validated = $request->validated();

        $boleto->update($validated);

        return redirect()->route('boleto.index')
            ->with('message', 'Boleto editado.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Boleto  $boleto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boleto $boleto)
    {
        try {
            $boleto->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('boleto.index')
                ->with('message', 'Peticion no puede ser procesada boleto no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('boleto.index')
            ->with('message', 'boleto eliminado.')
            ->with('status', 'success');
    }

    public function search()
    {
        return redirect()->route('boleto.index')
            ->with('title', 'Busqueda de boleto')
            ->with('message', 'Use el buscador para encontrar un boleto.')
            ->with('status', 'info');
    }
}
