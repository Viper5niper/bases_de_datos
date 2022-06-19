@extends('adminlte::page')

@section('title', 'Trabajos Realizados')

@section('content_header')
@include('common.status')

<div class="container">
<div class="card col-lg-12 d-flex justify-content-center p-3">
    <div class="row">
    <h1 class="col">Trabajos cotizados</h1>
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

<div class="col-lg-12 card pt-3 pb-3 mt-n3" data-intro="Bienvenido a la seccion de cotizaciones. Aca puede ver una tabla con las mismas funciones que los demas apartados. Si ya registro una cotizacion, por favor continue con el tutorial. Si no ha registrado ninguna, vuelva cuando halla registrado una para poder continuar el tutorial.">
  @php
  $heads = [
  'VIN',
  'Placa',
  'Vehiculo',//Aca se une la info de marca, modelo y anio
  'Propietario',
  'Descripcion',
  'Costo',
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
      <td>{{($ordentrabajo->monto_servicio)}}</td>
      <td>
        <nobr>
          <a href="{{route('ordenestrabajo.printcotizacion',['ordenestrabajo' => $ordentrabajo->id])}}"
            onclick="window.open(this.href).print(); return false" class="btn btn-outline-secondary"
            data-toggle="tooltip" data-placement="top" title="Imprimir cotizacion" @if($key == 0) data-intro="Este boton le servira para imprimir la cotizacion al cliente" @endif>
              <i class="fas fa-print"></i></a>
          <a href="{{route('ordenestrabajo.edit',['ordenestrabajo' => $ordentrabajo->id])}}"
            class="btn btn-outline-primary" @if($key == 0) data-intro="Puede usar este boton para crear una nueva orden de trabajo a partir de la cotizacion ya hecha. NOTA: Solo podra ingresar el pago DESPUES de haber hecho la orden de trabajo." @endif><i class="fas fa-clipboard-check" data-toggle="tooltip" data-placement="top"
              title="Crear Orden de Trabajo"></i></a>
          <span onclick="eliminar('{{route('ordenestrabajo.destroy',['ordenestrabajo' => $ordentrabajo->id])}}');"
            data-toggle="modal" data-target="#DeletedModal">
            <a class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Cotizacion" @if($key == 0) data-intro="En caso de que el cliente no acepte el trabajo, o no se halla acercado en mucho tiempo, puede eliminar la orden de trabajo con este boton." @endif><i
                class="fas fa-trash"></i></a>
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