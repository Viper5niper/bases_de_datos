<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\OrdenTrabajo;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::get();

        //dd($pagos);

        // sacamos estadisticas.
        $date = \Carbon\Carbon::today()->subDays(30);
        $monthlypays = Pago::where('created_at', '>=', $date)->count();
        $monthlyincome = Pago::where('created_at', '>=', $date)->sum('monto');

        $date = \Carbon\Carbon::today()->subDays(7);
        $sevendayspays = Pago::where('created_at', '>=', $date)->count();
        $sevendaysincome = Pago::where('created_at', '>=', $date)->sum('monto');

        $stats = array();
        $stats['monthlypays'] = $monthlypays;
        $stats['monthlyincome'] = $monthlyincome;
        $stats['sevendayspays'] = $sevendayspays;
        $stats['sevendaysincome'] = $sevendaysincome;
        return view('pagos.index', ['pagos' => $pagos, 'stats' => $stats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $ordentrabajo = !$req->has('idot') ? new OrdenTrabajo() : OrdenTrabajo::findOrFail($req->query('idot'));
        return view('pagos.create', ['pago' => new Pago, 'ordentrabajo' => $ordentrabajo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request)
    {
        $validated = $request->validated();

        $new = Pago::create($validated);

        return redirect()->route('ordenestrabajo.show',['ordenestrabajo' => $new->ordentrabajo_id])
            ->with('title', 'Exito!')
            ->with('message', 'Pago registrado con exito.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
       return view('pagos.edit', ['pago' => $pago, 'ordentrabajo' => $pago->ordentrabajo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePagoRequest  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        $validated = $request->validated();

        $pago->update($validated);

        //redirect(route('ordenestrabajo.show',['ordenestrabajo' => $pago->ordentrabajo_id]) . '#tablapagos')

        return redirect()->route('ordenestrabajo.show',['ordenestrabajo' => $pago->ordentrabajo_id])
            ->with('title', 'Exito!')
            ->with('message', 'Pago editado con exito.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        $id = $pago->ordentrabajo_id;
        try {
            $pago->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('ordenestrabajo.show',['ordenestrabajo' => $id])
                ->with('title', 'Error')
                ->with('message', 'Peticion no puede ser procesada, el pago no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('ordenestrabajo.show',['ordenestrabajo' => $id])
            ->with('title', 'Pago Eliminado')
            ->with('message', 'El pago ha sido eliminado correctamnte.')
            ->with('status', 'success');
    }
}
