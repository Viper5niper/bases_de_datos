<?php

namespace App\Http\Controllers;

use App\Models\OrdenTrabajo;
use App\Models\Cliente;
use App\Http\Requests\StoreOrdenTrabajoRequest;
use App\Http\Requests\StoreCotizacionRequest;
use App\Http\Requests\UpdateOrdenTrabajoRequest;
use App\Models\Pago;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class OrdenTrabajoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //al hacer clic en pendientes de pago, que le muestre una vista que solo tenga un boton de pagar
    {
        $ordentrabajos = OrdenTrabajo::get()->where('cotizacion',0);    //todos los que no sean cotizacion

        // sacamos estadisticas.
        $date = \Carbon\Carbon::today()->subDays(7);
        $sevendays = OrdenTrabajo::where('created_at', '>=', $date)->where('cotizacion',0)->count();

        $date = \Carbon\Carbon::today()->subDays(30);
        $thirtydays = OrdenTrabajo::where('created_at', '>=', $date)->where('cotizacion',0)->count();

        $pending = OrdenTrabajo::where('pagado', 0)->where('cotizacion',0)->count();
        
        $cotized = OrdenTrabajo::where('cotizacion', 1)->count();

        $date = \Carbon\Carbon::today()->addDays(7); //traer el numero de dias desde la configuracion
        $today = \Carbon\Carbon::today();
        $nearcalls = OrdenTrabajo::where('proximo_servicio', '!=', null)
            ->where('proximo_servicio', '>=', $today)->where('proximo_servicio', '<=', $date)
            ->where('cotizacion',0)
            ->where('contactado','0')
            ->count();
        
        $stats = array();
        $stats['sevendays'] = $sevendays;
        $stats['thirtydays'] = $thirtydays;
        $stats['pending'] = $pending;
        $stats['nearcalls'] = $nearcalls;
        $stats['cotized'] = $cotized;
        
        //dd($stats);
        //dd($ordentrabajos);
        return view('ordenestrabajo.index', ['ordentrabajos' => $ordentrabajos, 'stats' => $stats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $cliente = !$req->has('idc') ? new Cliente : Cliente::findOrFail($req->query('idc'));
        return view('ordenestrabajo.create', ['ordentrabajo' => new OrdenTrabajo, 'cliente' => $cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrdenTrabajoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrdenTrabajoRequest $request)
    {
        $validated = $request->validated();

        $new = OrdenTrabajo::create($validated);
        
        if($new->cancelado_servicio > 0){
            $pago = Pago::create([
            'ordentrabajo_id' => $new->id,
            'monto' => $new->cancelado_servicio,
            'metodo' => $request->validated()['metodo'],
        ]);
        }

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                //1NISSANFRONTIER_  imagen001.jpg
                $filename = $new->id . $new->marca_vehiculo . $new->modelo_vehiculo . '_' .$image->getClientOriginalName();
                Storage::putFileAs('public/ordenestrabajo/', $image, $filename);
            }
        }

        return redirect()->route('ordenestrabajo.index')
            ->with('title', 'Exito!')
            ->with('message', 'Orden de trabajo creada con exito.')
            ->with('status', 'success');
    }
    
    public function storeCotizacion(StoreCotizacionRequest $request)
    {
        $validated = $request->validated();

        $new = OrdenTrabajo::create(array_merge($validated,['cotizacion' => 1]));

        return redirect()->route('ordenestrabajo.cotizaciones')
            ->with('title', 'Exito!')
            ->with('message', 'Cotizacion creada con exito.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdenTrabajo  $ordenTrabajo
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenTrabajo $ordenestrabajo)
    {
        //dd($ordenestrabajo->getOrdenTrabajoFilesNames());
        $images = $ordenestrabajo->getOrdenTrabajoFilesNames();
        return view('ordenestrabajo.show', ['ordentrabajo' => $ordenestrabajo, 'cliente' => $ordenestrabajo->cliente, 'pagos' => $ordenestrabajo->pagos, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdenTrabajo  $ordentrabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenTrabajo $ordenestrabajo)
    {
        return view('ordenestrabajo.edit', ['ordentrabajo' => $ordenestrabajo, 'cliente' => $ordenestrabajo->cliente, 'pagos' => $ordenestrabajo->pagos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdenTrabajoRequest  $request
     * @param  \App\Models\OrdenTrabajo  $ordenTrabajo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdenTrabajoRequest $request, OrdenTrabajo $ordenestrabajo)
    {
        $validated = $request->validated();

        //dd($validated);
        // Cuando las fechas no son nullable, mysql por defecto deja la funcion OnUpdateCurrentTiemstamp
        // Asi que cada vez que se hace update se cambian las fechas no nullable a current tiemstamp
        $ordenestrabajo->update($validated);
        
        $ordenestrabajo->cotizacion = 0;
        $ordenestrabajo->saveQuietly();

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                //1NISSANFRONTIER_  imagen001.jpg
                $filename = $ordenestrabajo->id . $ordenestrabajo->marca_vehiculo . $ordenestrabajo->modelo_vehiculo . '_' .$image->getClientOriginalName();
                Storage::putFileAs('public/ordenestrabajo/', $image, $filename);
            }
        }

        return redirect()->route('ordenestrabajo.index')
            ->with('title', 'Exito!')
            ->with('message', 'Orden de trabajo editada con exito.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdenTrabajo  $ordenTrabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenTrabajo $ordenestrabajo)
    {
        try {
            $ordenestrabajo->deleteOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('ordenestrabajo.index')
                ->with('title', 'Error')
                ->with('message', 'Peticion no puede ser procesada, la orden de trabajo no existe [S003]')
                ->with('status', 'warning');
        }

        return redirect()->route('ordenestrabajo.index')
            ->with('title', 'Orden de trabajo eliminada')
            ->with('message', 'La orden de trabajo ha sido eliminada correctamnte.')
            ->with('status', 'success');
    }

    public function print(OrdenTrabajo $ordenestrabajo)
    {
        return view('ordenestrabajo.print2', ['ordentrabajo' => $ordenestrabajo, 'cliente' => $ordenestrabajo->cliente, 'pagos' => $ordenestrabajo->pagos,]);
    }
    
    public function printcotizacion(OrdenTrabajo $ordenestrabajo)
    {
        //$ordenestrabajo = new OrdenTrabajo;
        return view('ordenestrabajo.print3', ['ordentrabajo' => $ordenestrabajo, 'cliente' => $ordenestrabajo->cliente]);
    }

    public function pay() //al hacer clic en pendientes de pago, que le muestre una vista que solo tenga un boton de pagar
    {
        $ordentrabajos = OrdenTrabajo::where('pagado',0)->where('cotizacion',0)->get();
        
        //dd($stats);
        //dd($ordentrabajos);
        return view('ordenestrabajo.pay', ['ordentrabajos' => $ordentrabajos]);
    }
    
    public function cotizaciones() //al hacer clic en pendientes de pago, que le muestre una vista que solo tenga un boton de pagar
    {
        $ordentrabajos = OrdenTrabajo::where('cotizacion',1)->get();
        return view('ordenestrabajo.cotizaciones', ['ordentrabajos' => $ordentrabajos]);
    }

    public function contact() //al hacer clic en pendientes de pago, que le muestre una vista que solo tenga un boton de pagar
    {
        $date = \Carbon\Carbon::today()->addDays(5); //traer el numero de dias desde la configuracion
        $today = \Carbon\Carbon::today();

        $ordentrabajos = OrdenTrabajo::where('proximo_servicio', '!=', null)
        ->where('proximo_servicio', '>=', $today)->where('proximo_servicio', '<=', $date)
        ->where('cotizacion',0)
        ->where('contactado','0')->get();
        
        //dd($stats);
        //dd($ordentrabajos);
        return view('ordenestrabajo.contact', ['ordentrabajos' => $ordentrabajos]);
    }

    public function makecontact(OrdenTrabajo $ordenestrabajo){

        $ordenestrabajo->contactado = true;
        $ordenestrabajo->save();

        return redirect()->route('ordenestrabajo.contact')
            ->with('title', 'Exito')
            ->with('message', 'Se establecio al cliente de la orden de trabajo como contactado.')
            ->with('status', 'success');
    }
}
