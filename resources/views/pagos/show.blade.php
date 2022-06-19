@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-lg-12 my-3 p-3">
            <div class="row">

                <h3 class="col-md-6">Info del cliente</h3>
                <div class="col-md-2"> <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-block btn-md"><span><i class="fas fa-pen"></i> Editar</span></a> </div>
                <div class="col-md-2"> <a onclick="eliminar('{{route('clientes.destroy',$cliente->id)}}');" class="btn btn-danger btn-block btn-md"  data-toggle="modal"
                    data-target="#DeletedModal"><span><i class="fas fa-trash"></i> Eliminar</span></a> </div>
                    <div class="col-md-2"> <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-block btn-md"><span><i class="fas fa-arrow-left"></i> Regresar</span></a> </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card d-flex justify-content-center mx-auto my-3 p-5">       
            <form class="form-horizontal" method="POST" action="{{ route('clientes.update',$cliente->id) }}" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-8">
                    <label for="id_nombre">Nombre del Cliente</label>
                    <input type="text" name="nombre" class="form-control" id="id_nombre" value="{{old('nombre',$cliente->nombre)}}" disabled>
                    </div>
                
                    <div class="form-group col-md-4">
                    <label for="id_telefono">Telefono del Cliente</label>
                    <input type="text" name="telefono" class="form-control" id="id_telefono" value="{{old('telefono',$cliente->telefono)}}" disabled>
                    </div>
                
                    

                </div>
            </form>
        </div>
    </div>
</div>
@include('common.modaldelete',
['modal_title'=> 'Eliminar Cliente',
'modal_message'=>'Esta seguro que desea eliminar este cliente?','btnTipo'=>'danger',
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