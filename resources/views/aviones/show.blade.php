@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-lg-12 my-3 p-3">
            <div class="row">

                <h3 class="col-md-6">Info del Avion</h3>
                <div class="col-md-2"> <a href="{{ route('avion.edit', $avion->id) }}" class="btn btn-primary btn-block btn-md"><span><i class="fas fa-pen"></i> Editar</span></a> </div>
                <div class="col-md-2"> <a onclick="eliminar('{{route('avion.destroy',$avion->id)}}');" class="btn btn-danger btn-block btn-md"  data-toggle="modal"
                    data-target="#DeletedModal"><span><i class="fas fa-trash"></i> Eliminar</span></a> </div>
                    <div class="col-md-2"> <a href="{{ route('avion.index') }}" class="btn btn-secondary btn-block btn-md"><span><i class="fas fa-arrow-left"></i> Regresar</span></a> </div>
                </div>
            </div>
    </div>

    <div class="row">
        <div class="col-lg-12 card d-flex justify-content-center mx-auto my-3 p-5">       
            <form class="form-horizontal" method="POST" action="{{ route('avion.update',$avion->id) }}" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-6">
                    <label for="id_aerolinea">Aerolinea</label>
                    <input type="text" name="aerolinea" class="form-control" id="id_aerolinea" value="{{old('aerolinea',$avion->aerolinea->nombre)}}" disabled>
                    </div>
                
                    <div class="form-group col-md-6">
                    <label for="id_modelo">Modelo</label>
                    <input type="text" name="modelo" class="form-control" id="id_modelo" value="{{old('modelo',$avion->modelo)}}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="id_fabricante">Fabricante</label>
                    <input type="text" name="fabricante" class="form-control" id="id_fabricante" value="{{old('fabricante',$avion->fabricante)}}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="id_capacidad">Capacidad</label>
                    <input type="text" name="capacidad" class="form-control" id="id_capacidad" value="{{old('capacidad',$avion->capacidad)}}" disabled>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('common.modaldelete',
['modal_title'=> 'Eliminar Avion',
'modal_message'=>'Esta seguro que desea eliminar este avion?','btnTipo'=>'danger',
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