@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-lg-12 my-3 p-3">
            <div class="row">

                <h3 class="col-md-6">Info del Vuelo</h3>
                <div class="col-md-2"> <a href="{{ route('vuelo.edit', $vuelo->id) }}" class="btn btn-primary btn-block btn-md"><span><i class="fas fa-pen"></i> Editar</span></a> </div>
                <div class="col-md-2"> <a onclick="eliminar('{{route('vuelo.destroy',$vuelo->id)}}');" class="btn btn-danger btn-block btn-md"  data-toggle="modal"
                    data-target="#DeletedModal"><span><i class="fas fa-trash"></i> Eliminar</span></a> </div>
                    <div class="col-md-2"> <a href="{{ route('vuelo.index') }}" class="btn btn-secondary btn-block btn-md"><span><i class="fas fa-arrow-left"></i> Regresar</span></a> </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card d-flex justify-content-center mx-auto my-3 p-5">       
            <form class="form-horizontal" method="POST" action="{{ route('vuelo.update',$vuelo->id) }}" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-6">
                    <label for="id_origen">Origen</label>
                    <input type="text" name="origen" class="form-control" id="id_origen" value="{{old('origen',$vuelo->origen_id)}}" disabled>
                    </div>
                
                    <div class="form-group col-md-6">
                    <label for="id_destino">Destino</label>
                    <input type="text" name="destino" class="form-control" id="id_destino" value="{{old('destino',$vuelo->destino_id)}}" disabled>
                    </div>
                
                    <div class="form-group col-md-6">
                    <label for="id_avion">Avion</label>
                    <input type="text" name="avion" class="form-control" id="id_avion" value="{{old('avion',$vuelo->avion_id)}}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="id_despegue">Despegue</label>
                    <input type="text" name="despegue" class="form-control" id="id_despegue" value="{{old('despegue',$vuelo->despegue)}}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="id_aterrizaje">Aterrizaje</label>
                    <input type="text" name="aterrizaje" class="form-control" id="id_aterrizaje" value="{{old('aterrizaje',$vuelo->aterrizaje)}}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="id_precio">Precio</label>
                    <input type="text" name="precio" class="form-control" id="id_precio" value="{{old('precio',$vuelo->precio)}}" disabled>
                    </div>

                    <div class="form-group col-md-12">
                    <label for="id_recorrido">Recorrido</label>
                    <input type="text" name="recorrido" class="form-control" id="id_recorrido" value="{{old('recorrido',$vuelo->recorrido)}}" disabled>
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