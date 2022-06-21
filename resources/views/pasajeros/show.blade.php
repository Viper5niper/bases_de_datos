@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-lg-12 my-3 p-3">
            <div class="row">

                <h3 class="col-md-6">Info de Pasajero</h3>
                <div class="col-md-2"> <a href="{{ route('pasajeros.edit', $pasajero->id) }}" class="btn btn-primary btn-block btn-md"><span><i class="fas fa-pen"></i> Editar</span></a> </div>
                <div class="col-md-2"> <a onclick="eliminar('{{route('pasajeros.destroy', $pasajero->id)}}');" class="btn btn-danger btn-block btn-md"  data-toggle="modal"
                    data-target="#DeletedModal"><span><i class="fas fa-trash"></i> Eliminar</span></a> </div>
                    <div class="col-md-2"> <a href="{{ route('pasajeros.index') }}" class="btn btn-secondary btn-block btn-md"><span><i class="fas fa-arrow-left"></i> Regresar</span></a> </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card d-flex justify-content-center mx-auto my-3 p-5">       
            <form class="form-horizontal" method="POST" action="{{ route('pasajeros.update', $pasajero->id) }}" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="id_nombre">Nombre de el Pasajero</label>
                        <input type="text" name="nombre" class="form-control" id="id_nombre" value="{{old('nombre',$pasajero->nombre)}}" disabled>
                    </div>   
                    
                    <div class="form-group col-md-12">
                        <label for="id_apellido">Apellido de el Pasajero</label>
                        <input type="text" name="apellido" class="form-control" id="id_apellido" value="{{old('apellido',$pasajero->apellido)}}" disabled>
                    </div>    

                    <div class="form-group col-md-12">
                        <label for="id_genero">Genero de el Pasajero</label>
                        <input type="text" name="genero" class="form-control" id="id_genero" value="{{old('genero',$pasajero->genero)}}" disabled>
                    </div>    

                    <div class="form-group col-md-12">
                        <label for="ubicacion_id">Ubicacion de el Pasajero</label>
                        <input type="text" name="ubicacion" class="form-control" id="ubicacion_id" value="{{old('ubicacion',$pasajero->ubicacion_id)}}" disabled>
                    </div>    

                    <div class="form-group col-md-12">
                        <label for="id_nacimiento">Fecha de Nacimiendo de el Pasajero</label>
                        <input type="text" name="fecha_nacimiento" class="form-control" id="id_nacimiento" value="{{old('fecha_nacimiento',$pasajero->fecha_nacimiento)}}" disabled>
                    </div>    

                </div>
            </form>
        </div>
    </div>
</div>
@include('common.modaldelete',
['modal_title'=> 'Eliminar Pasajero',
'modal_message'=>'Esta seguro que desea eliminar este Pasajero?','btnTipo'=>'danger',
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