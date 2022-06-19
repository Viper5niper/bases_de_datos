@extends('adminlte::page')

@section('title', 'Orden de Trabajo')

@section('content_header')
@include('common.status')


<div class="card col-lg-12 d-flex justify-content-center p-3">
  <div class="row">
    <h1 class="col">Orden de trabajo detallada</h1>
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

@stop

@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-12 card d-flex justify-content-center mx-auto p-5">
      <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">

        <div class="form-row"
          data-intro='Bienvenido a la vista Detallada. Aca puede ver a detalle toda la informacion de la orden de trabajo. Tambien se incluye a continuacion un menu de acciones que puede realizar con esta orden de trabajo'>

          <div class="container row">

            @if(!empty($images))
            <div class="col-md-12 fotorama mb-3" data-allowfullscreen="true" data-nav="thumbs">
              @foreach ($images as $image)
              <a href=""><img src="{{URL::asset('storage/ordenestrabajo/'.$image.'')}}"></a>
              @endforeach
            </div>
            @endif

            <h3 class="col-md-12 text-center" id="cliente">Cliente</h3>
            <div class="form-group col-md-9">
              <label for="ot_vin_vehiculo">Nombre del Cliente</label>
              <input type="text" class="form-control" id="ot_vin_vehiculo" value="{{old('nombre',$cliente->nombre)}}"
                disabled>
            </div>

            <div class="form-group col-md-3">
              <label for="ot_vin_vehiculo">Telefono del Cliente</label>
              <input type="text" class="form-control" id="ot_vin_vehiculo"
                value="{{old('telefono',$cliente->telefono)}}" disabled>
            </div>

            <div class="form-group col-md-9 offset-md-3"
              data-intro='Este control le indicara si usted ya ha llamado a este cliente para su proximo mantenimiento. Puede editarlo desde el menu que le presentamos a continuacion'>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" disabled name="contactado" type="checkbox" id="id_contactado"
                  {{old('contactado',$ordentrabajo->contactado) ? "checked" : null}} onclick="this.value = this.checked
                ? 1 : 0" value="{{old('contactado',$ordentrabajo->contactado)}}">
                <label for="id_contactado" class="custom-control-label">El cliente ha sido contactado para su proximo
                  mantenimiento</label>
              </div>
            </div>

            <input type="number" hidden name="cliente_id" value="{{$cliente->id}}">
          </div>

          <div class="container row">

            <h3 class="col-md-12 text-center my-4" id="vehiculo">Vehiculo</h3>

            <div class="form-group col-md-6">
              <label for="id_propietario_vehiculo">Nombre del Propietario</label>
              <input type="text" name="propietario_vehiculo" class="form-control" id="id_propietario_vehiculo"
                value="{{old('propietario_vehiculo',$ordentrabajo->propietario_vehiculo)}}" disabled>
            </div>

            <div class="form-group col-md-3">
              <label for="id_vin_vehiculo">VIN</label>
              <input type="text" name="vin_vehiculo" class="form-control" id="id_vin_vehiculo"
                value="{{old('vin_vehiculo',$ordentrabajo->vin_vehiculo)}}" disabled>
            </div>

            <div class="form-group col-md-3">
              <label for="id_placa_vehiculo">Placa</label>
              <input type="text" name="placa_vehiculo" class="form-control" id="id_placa_vehiculo"
                value="{{old('placa_vehiculo',$ordentrabajo->placa_vehiculo)}}" disabled>
            </div>

            <div class="form-group col-md-2">
              <label for="id_anio">Anio</label>
              <input type="number" min="1900" max="2100" name="anio_vehiculo" class="form-control" id="id_anio"
                value="{{old('anio_vehiculo',$ordentrabajo->anio_vehiculo)}}" onKeyUp="" disabled>
            </div>

            <div class="form-group col-md-3">
              <label for="id_marca">Marca</label>
              <input type="text" name="marca_vehiculo" class="form-control @error('marca_vehiculo') is-invalid 
                          @enderror" id="id_marca" value="{{old('marca_vehiculo',$ordentrabajo->marca_vehiculo)}}"
                disabled>
            </div>

            <div class="form-group col-md-3">
              <label for="id_modelo">Modelo</label>
              <input type="text" name="modelo_vehiculo" class="form-control @error('modelo_vehiculo') is-invalid 
                          @enderror" id="id_modelo" value="{{old('modelo_vehiculo',$ordentrabajo->modelo_vehiculo)}}"
                disabled>
            </div>

            <div class="form-group col-md-2">
              <label for="id_kilometraje">Kilometraje</label>
              <input type="number" name="kilometraje_vehiculo" class="form-control" id="id_kilometraje"
                value="{{$ordentrabajo->unidad_vehiculo == 'Km' ? $ordentrabajo->kilometraje_vehiculo : ceil( (int) $ordentrabajo->kilometraje_vehiculo * 1.609344)}}" disabled>
            </div>

            <div class="form-group col-md-2">
              <label for="id_millaje">Millaje</label>
              <input type="number" class="form-control" id="id_millaje"
                value="{{$ordentrabajo->unidad_vehiculo == 'Mi' ? $ordentrabajo->kilometraje_vehiculo : ceil( (int) $ordentrabajo->kilometraje_vehiculo / 1.609344)}}" disabled>
            </div>

            <input type="hidden" id="kms" name="kilometraje_vehiculo" value="1" type="number">

          </div> <!-- fin container row -->

          <div class="container row">

            <h3 class="col-md-12 text-center my-4" id="detalle">Detalle del Servicio</h3>

            <div class="form-group col-md-6">
              <label for="id_desc">Describa el servicio brindado</label>
              <input type="text" name="descripcion_servicio" class="form-control" id="id_desc"
                value="{{old('descripcion_servicio',$ordentrabajo->descripcion_servicio)}}" disabled>
            </div>

            <div class="form-group col-md-3">
              <label for="id_entrada">Fecha de recepcion</label>
              <input type="text" name="fecha_entrada" class="form-control" id="id_entrada"
                value="{{old('fecha_entrada',$ordentrabajo->fecha_entrada->format('Y-m-d'))}}" disabled>
            </div>

            <div class="form-group col-md-3">
              <label for="id_salida">Fecha de entrega</label>
              <input type="text" name="fecha_salida" class="form-control" id="id_salida"
                value="{{old('fecha_salida',$ordentrabajo->fecha_salida->format('Y-m-d'))}}" disabled>
            </div>
            
            <div class="form-group col-md-12">
              <label for="id_trabajorealizado">Trabajo realizado</label>
              <textarea type="text" name="trabajo_realizado" class="form-control" id="id_trabajorealizado"
                disabled>{{old('observacion_servicio',$ordentrabajo->trabajo_realizado)}}</textarea>
            </div>
            
            <div class="form-group col-md-12">
              <label for="id_observaciones">Observaciones</label>
              <textarea type="text" name="observacion_servicio" class="form-control" id="id_observaciones"
                disabled>{{old('observacion_servicio',$ordentrabajo->observacion_servicio)}}</textarea>
            </div>

          </div> <!-- fin container row -->

          @include('ordenestrabajo.tablacotizdisabled')

          <div class="form-group col-md-8" id="extra">
            <label for="id_encargado">Encargado del servicio</label>
            <input type="text" name="tecnico_encargado" class="form-control" id="id_encargado"
              value="{{old('tecnico_encargado',$ordentrabajo->tecnico_encargado)}}" disabled>
          </div>

          <div class="form-group col-md-4">
            <label for="id_proximo">Proximo servicio</label>
            <input type="text" name="proximo_servicio" class="form-control" id="id_proximo"
              value="{{$ordentrabajo->proximo_servicio ? $ordentrabajo->proximo_servicio->format('Y-m-d') : 'no se especifico un proximo servicio'}}"
              disabled>
          </div>
        </div>

        <br>

        <div class="row">
          <div class="form-button col-md-4" data-intro='Presione este boton para imprimir esta orden de trabajo'>
            <a href="{{route('ordenestrabajo.print',['ordenestrabajo' => $ordentrabajo->id])}}"
              onclick="window.open(this.href).print(); return false" class="btn-block btn-lg text-center btn-success"
              data-toggle="tooltip" data-placement="top" title="Imprimir orden de trabajo"><i class="fas fa-print"></i>
              Imprimir</a>
          </div>
          <div class="form-button col-md-4" data-intro='Aca puede editar la orden de trabajo'>
            <a href="{{route('ordenestrabajo.edit',['ordenestrabajo' => $ordentrabajo->id])}}"
              class="btn-block btn-lg text-center btn-primary"><i class="fas fa-pen" data-toggle="tooltip"
                data-placement="top" title="Editar informacion"></i> Editar</a>
          </div>
          <div class="form-button col-md-4"
            data-intro='Desde aca puede eliminar la orden de trabajo. Al presionar el boton se preguntara si esta seguro de querer eliminarla.'>
            <span onclick="eliminar('{{route('ordenestrabajo.destroy',['ordenestrabajo' => $ordentrabajo->id])}}');"
              data-toggle="modal" data-target="#DeletedModal">
              <a class="btn-block btn-lg text-center btn-danger" data-toggle="tooltip" data-placement="top"
                title="Eliminar cliente"><i class="fas fa-trash"></i> Eliminar</a>
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@include('common.modaldelete',
['modal_title'=> 'Eliminar Orden de Trabajo?',
'modal_message'=>'Esta seguro que desea eliminar esta orden de trabajo?','btnTipo'=>'danger',
'ruta'=>''])

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
@stop

@section('js')
<script>
  console.log('Hi!'); 
</script>
<script type="application/javascript">
  function eliminar(e){
    //console.log(e);
    let form = document.getElementById('form-delete');
    form.setAttribute("action",e);
  }
</script>
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
@stop