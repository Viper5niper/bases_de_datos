@extends('adminlte::page')

@section('title', 'Trabajos Realizados')

@section('content_header')
@include('common.status')

<div class="container">
<div class="card col-lg-12 d-flex justify-content-center p-3">
    <div class="row">
    <h1 class="col">Pendientes de pago</h1>
    <div class="col">
        <button class="btn btn-md btn-info float-right" onclick="introJs().start();"><i class="fas fa-question-circle"></i> 
            Ayuda
        </button>
    </div>
    <div class="">
        <a href="{{ route('ordenestrabajo.index') }}" class="btn btn-md btn-secondary float-right"><i class="fas fa-arrow-left"></i> 
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

<div class="col-lg-12 card pt-3 pb-3 mt-n3">
  @php
  $heads = [
  'VIN',
  'Placa',
  'Vehiculo',//Aca se une la info de marca, modelo y anio
  'Propietario',
  'Descripcion',
  'Costo',
  'Cancel.',
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
      <td>{{($ordentrabajo->monto_servicio)}}</td>
      <td>{{($ordentrabajo->cancelado_servicio)}}</td>
      <td>
        <nobr>
          <a href="{{route('pagos.create',['idot' => $ordentrabajo->id])}}" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Registrar un pago"><i class="fas fa-dollar-sign"></i></a>
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
@stop