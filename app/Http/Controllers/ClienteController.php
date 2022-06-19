<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\OrdenTrabajo;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::get();

        // sacamos estadisticas.
        $date = \Carbon\Carbon::today()->subDays(7);
        $sevendays = Cliente::where('created_at', '>=', $date)->count();

        $date = \Carbon\Carbon::today()->addDays(5); //traer el numero de dias desde la configuracion
        $today = \Carbon\Carbon::today();
        $nearcalls = OrdenTrabajo::where('proximo_servicio', '!=', null)
            ->where('proximo_servicio', '>=', $today)->where('proximo_servicio', '<=', $date)
            ->where('contactado','0')
            ->count();

        $stats = array();
        $stats['sevendays'] = $sevendays;
        $stats['nearcalls'] = $nearcalls;
        return view('clientes.index', ['clientes' => $clientes, 'stats' => $stats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create', ['cliente' => new Cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $validated = $request->validated();

        Cliente::create($validated);

        return redirect()->route('clientes.index')
            ->with('message', 'Cliente creado.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $validated = $request->validated();

        $cliente->update($validated);

        return redirect()->route('clientes.index')
            ->with('message', 'Cliente editado.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('clientes.index')
                ->with('message', 'Peticion no puede ser procesada cliente no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('clientes.index')
            ->with('message', 'cliente eliminado.')
            ->with('status', 'success');
    }

    public function search()
    {
        return redirect()->route('clientes.index')
            ->with('title', 'Busqueda de cliente')
            ->with('message', 'Use el buscador para encontrar un cliente, o bien, registre un nuevo cliente. Para realizar un trabajo a dicho cliente, presione el boton de martillo.')
            ->with('status', 'info');
    }
}
