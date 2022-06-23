<?php

namespace App\Http\Controllers;

//use App\Models\Etl;
use App\Http\Requests\StoreAerolineaRequest;
use App\Http\Requests\UpdateAerolineaRequest;
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
