@extends('adminlte::page')

@section('title', 'Trabajos Realizados')

@section('content_header')
@include('common.status')

<div class="container">
  <div class="card col-lg-12 d-flex justify-content-center p-3">
    <div class="row">
      <h1 class="col">Contactar clientes</h1>
      <div class="col">
        <button class="btn btn-md btn-info float-right" onclick="introJs().start();"><i
            class="fas fa-question-circle"></i>
          Ayuda
        </button>
      </div>
      <div class="">
        <a href="{{ route('ordenestrabajo.index') }}" class="btn btn-md btn-secondary float-right"><i
            class="fas fa-arrow-left"></i>
          Volver al Inicio
        </a>
      </div>
    </div>
  </div>
</div>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)


@section('content')

<div class="col-lg-12 card pt-3 pb-3 mt-n3" data-intro="Bienvenido a la seccion de contacto con los clientes. Esta seccion le mostrara los clientes cuyo 'proximo servicio' este dentro de los siguientes 5 dias. Si se muestran clientes por contactar en la tabla, por favor continue con el tutorial. Si no hay ninguno, por favor vuelva mas adelante cuando existan registros para poder continuar el tutorial.">
  @php
  $heads = [
  'VIN',
  'Placa',
  'Vehiculo',//Aca se une la info de marca, modelo y anio
  'Propietario',
  'Descripcion',
  'Recepcion',
  'Telefono',
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
    @foreach($ordentrabajos as $key => $ordentrabajo)
    <tr>
      <td>{{($ordentrabajo->vin_vehiculo)}}</td>
      <td>{{($ordentrabajo->placa_vehiculo)}}</td>
      <td>{{$ordentrabajo->marca_vehiculo . " " . $ordentrabajo->modelo_vehiculo . " " . $ordentrabajo->anio_vehiculo}}
      </td>
      <td>{{($ordentrabajo->propietario_vehiculo)}}</td>
      <td>{{($ordentrabajo->descripcion_servicio)}}</td>
      <td>{{($ordentrabajo->fecha_entrada->format('Y-m-d'))}}</td>
      <td>{{($ordentrabajo->cliente->telefono)}}</td>
      <td><span class="badge bg-{{($ordentrabajo->pagado ? "success" : "danger" )}}">{{($ordentrabajo->pagado ?
          "CANCELADO" : "PENDIENTE")}}</span></td>
      <td>
        <nobr>
          <a href="{{route('ordenestrabajo.show',['ordenestrabajo' => $ordentrabajo->id])}}" @if($key == 0) data-intro="Con este boton puede ver la informacion detallada del trabajo que se realizo al cliente anteriormente." @endif
            class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Ver informacion detallada"><i
              class="fas fa-eye"></i></a>
          <a href="{{route('ordenestrabajo.makecontact',['ordenestrabajo' => $ordentrabajo->id])}}" @if($key == 0) data-intro="Una vez halla contactado al cliente, presione este boton para marcarlo como contactado, asi el registro ya no se mostrara en esta seccion." @endif
            class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Marcar como contactado"><i
              class="fas fa-phone"></i></a>
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