@extends('adminlte::page')

@section('title', 'Trabajos Realizados')

@section('content_header')
@include('common.status')

<div class="card col-lg-12 justify-content-center p-3">
  <div class="row">
    <h1 class="col">{{isset($custommsg) ? $custommsg : "Trabajos realizados"}}</h1>
    <div class="col">
      <button class="btn btn-md btn-info float-right" onclick="introJs().start();"><i
          class="fas fa-question-circle"></i>
        Ayuda
      </button>
    </div>
    <div class="">
      <a class="btn btn-md btn-danger float-right" href="{{route('ordenestrabajo.create')}}"><i class="fas fa-plus"></i>
        Nueva orden de trabajo
      </a>
    </div>
  </div>
</div>

@if (!isset($custommsg))

<div class="row" data-intro="En esta parte encontraremos algunas estadisticas.">

  <div class="col-lg-3 col-6">
    <div class="small-box bg-secondary" data-intro="Este es el numero de trabajos registrados en el sistema durante los ultimos 7 dias.">
      <div class="inner">
        <h3>{{$stats['sevendays']}}</h3>
        <p>Ultimos 7 dias</p>
      </div>
      <div class="icon">
        <i class="fas fa-cog"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info" data-intro="Este es el numero de trabajos registrados en el sistema durante los ultimos 30 dias.">
      <div class="inner">
        <h3>{{$stats['thirtydays']}}</h3>
        <p>Ultimos 30 dias</p>
      </div>
      <div class="icon">
        <i class="fas fa-cogs"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <div class="small-box bg-teal" onclick="window.open('{{route('ordenestrabajo.cotizaciones')}}','_self')" data-intro="Aca encontrara las cotizaciones que los clientes solicitaron, pero que quedaron pendientes para venir a realizar el trabajo.">
      <div class="inner">
        <h3>{{$stats['cotized']}}</h3>
        <p>Cotizados</p>
      </div>
      <div class="icon">
        <i class="fas fa-file-invoice-dollar"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <div class="small-box bg-danger" onclick="window.open('{{route('ordenestrabajo.pay')}}','_self')" data-intro="Aca se encuentran TODAS las ordenes de trabajo pendientes de pago. Podemos consultarlas dando clic sobre este panel.">
      <div class="inner">
        <h3>{{$stats['pending']}}</h3>
        <p>Pendientes de pago</p>
      </div>
      <div class="icon">
        <i class="fas fa-dollar-sign"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <div class="small-box bg-success" onclick="window.open('{{route('ordenestrabajo.contact')}}','_self')" data-intro="Aca encontrara mas informacion sobre los trabajos a los que se les asigno un proximo mantenimiento. Podemos consultarlos dando clic sobre este panel.">
      <div class="inner">
        <h3>{{$stats['nearcalls']}}</h3>
        <p>Proximos Mant.</p>
      </div>
      <div class="icon">
        <i class="fas fa-phone"></i>
      </div>
    </div>
  </div>
</div>
@endif
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)


@section('content')

<div class="col-lg-12 card pt-3 pb-3 mt-n3" data-intro="Finalmente, veremos todas las ordenes de trabajo listadas en esta tabla. Podemos imprimir los datos haciendo clic en los botones encima a la izquierda, o realizar una busqueda en el campo que esta encima a la derecha. Tambien podemos realizar acciones con cada trabajo realizado dando clic en sus botones de accion.">
  @php
  $heads = [
  'VIN',
  'Placa',
  'Vehiculo',//Aca se une la info de marca, modelo y anio
  'Propietario',
  'Descripcion',
  'Recepcion',
  'Pago',
  ['label' => 'Acciones', 'no-export' => true],
  ];
  $config = [
  'language' => [
  "url" => "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json",
  "paginate" => [
  "next" => '»',
  "previous" => '«'
  ],
  ],
  'order' => [[1, 'desc']],
  ];
  @endphp

  <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="light" striped hoverable beautify
    with-buttons>
    @foreach($ordentrabajos as $ordentrabajo)
    <tr>
      <td>{{($ordentrabajo->vin_vehiculo)}}</td>
      <td>{{($ordentrabajo->placa_vehiculo)}}</td>
      <td>{{$ordentrabajo->marca_vehiculo . " " . $ordentrabajo->modelo_vehiculo . " " . $ordentrabajo->anio_vehiculo}}
      </td>
      <td>{{($ordentrabajo->propietario_vehiculo)}}</td>
      <td>{{($ordentrabajo->descripcion_servicio)}}</td>
      <td>{{($ordentrabajo->fecha_entrada->format('Y-m-d'))}}</td>
      <td><span class="badge bg-{{($ordentrabajo->pagado ? "success" : "danger" )}}">{{($ordentrabajo->pagado ?
          "CANCELADO" : "PENDIENTE")}}</span></td>
      <td>
        <nobr>
          <a href="{{route('ordenestrabajo.print',['ordenestrabajo' => $ordentrabajo->id])}}"
            onclick="window.open(this.href).print(); return false" class="btn btn-outline-secondary"
            data-toggle="tooltip" data-placement="top" title="Imprimir orden de trabajo"><i
              class="fas fa-print"></i></a>
          <a href="{{route('ordenestrabajo.show',['ordenestrabajo' => $ordentrabajo->id])}}"
            class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Ver informacion detallada"><i
              class="fas fa-eye"></i></a>
          <a href="{{route('ordenestrabajo.edit',['ordenestrabajo' => $ordentrabajo->id])}}"
            class="btn btn-outline-primary"><i class="fas fa-pen" data-toggle="tooltip" data-placement="top"
              title="Editar informacion"></i></a>
          <span onclick="eliminar('{{route('ordenestrabajo.destroy',['ordenestrabajo' => $ordentrabajo->id])}}');"
            data-toggle="modal" data-target="#DeletedModal">
            <a class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Eliminar cliente"><i
                class="fas fa-trash"></i></a>
          </span>
        </nobr>
      </td>
    </tr>
    @endforeach
  </x-adminlte-datatable>
</div>

@include('common.modaldelete',
['modal_title'=> 'Eliminar Orden de Trabajo?',
'modal_message'=>'Esta seguro que desea eliminar esta orden de trabajo?','btnTipo'=>'danger',
'ruta'=>''])
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
@stop

@section('js')
<script src="https://unpkg.com/imask"></script>
<script src="/js/utilities.js"></script>
<script type="application/javascript">
  function eliminar(e){
    //console.log(e);
    let form = document.getElementById('form-delete');
    form.setAttribute("action",e);
  }
</script>
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
@stop