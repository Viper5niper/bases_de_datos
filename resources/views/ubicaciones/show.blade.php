@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-lg-12 my-3 p-3">
            <div class="row">

                <h3 class="col-md-6">Info de la Ubicacion</h3>
                <div class="col-md-2"> <a href="{{ route('ubicacion.edit', $ubicacion->id) }}" class="btn btn-primary btn-block btn-md"><span><i class="fas fa-pen"></i> Editar</span></a> </div>
                <div class="col-md-2"> <a onclick="eliminar('{{route('ubicacion.destroy',$ubicacion->id)}}');" class="btn btn-danger btn-block btn-md"  data-toggle="modal"
                    data-target="#DeletedModal"><span><i class="fas fa-trash"></i> Eliminar</span></a> </div>
                    <div class="col-md-2"> <a href="{{ route('ubicacion.index') }}" class="btn btn-secondary btn-block btn-md"><span><i class="fas fa-arrow-left"></i> Regresar</span></a> </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card d-flex justify-content-center mx-auto my-3 p-5">       
            <form class="form-horizontal" method="POST" action="{{ route('ubicacion.update',$ubicacion->id) }}" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-6">
                    <label for="id_pais">Pais</label>
                    <input type="text" name="pais" class="form-control" id="id_pais" value="{{old('pais',$ubicacion->pais)}}" disabled>
                    </div>
                
                    <div class="form-group col-md-6">
                    <label for="id_ciudad">Ciudad</label>
                    <input type="text" name="ciudad" class="form-control" id="id_ciudad" value="{{old('ciudad',$ubicacion->ciudad)}}" disabled>
                    </div>
                
                    <div class="form-group col-md-6">
                    <label for="id_latitud">Latitud</label>
                    <input type="text" name="latitud" class="form-control" id="id_latitud" value="{{old('latitud',$ubicacion->latitud)}}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="id_longitud">Longitud</label>
                    <input type="text" name="longitud" class="form-control" id="id_longitud" value="{{old('longitud',$ubicacion->longitud)}}" disabled>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@include('common.modaldelete',
['modal_title'=> 'Eliminar Ubicacion',
'modal_message'=>'Esta seguro que desea eliminar esta ubicacion?','btnTipo'=>'danger',
'ruta'=>''])
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://unpkg.com/imask"></script>
<script type="application/javascript">
  function eliminar(e){
    //console.log(e);
    let form = document.getElementById('form-delete');
    form.setAttribute("action",e);
  }
</script>
@stop