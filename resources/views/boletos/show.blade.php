@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-lg-12 my-3 p-3">
            <div class="row">

                <h3 class="col-md-6">Info del Boleto</h3>
                <div class="col-md-2"> <a href="{{ route('boleto.edit', $boleto->id) }}" class="btn btn-primary btn-block btn-md"><span><i class="fas fa-pen"></i> Editar</span></a> </div>
                <div class="col-md-2"> <a onclick="eliminar('{{route('boleto.destroy',$boleto->id)}}');" class="btn btn-danger btn-block btn-md"  data-toggle="modal"
                    data-target="#DeletedModal"><span><i class="fas fa-trash"></i> Eliminar</span></a> </div>
                    <div class="col-md-2"> <a href="{{ route('boleto.index') }}" class="btn btn-secondary btn-block btn-md"><span><i class="fas fa-arrow-left"></i> Regresar</span></a> </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card d-flex justify-content-center mx-auto my-3 p-5">       
            <form class="form-horizontal" method="POST" action="{{ route('boleto.update',$boleto->id) }}" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-6">
                    <label for="id_pasajero">Nombre del Pasajero</label>
                    <input type="text" name="pasajero" class="form-control" id="id_pasajero" value="{{old('pasajero',$boleto->pasajero_id)}}" disabled>
                    </div>
                
                    <div class="form-group col-md-6">
                    <label for="id_vuelo">Vuelo</label>
                    <input type="text" name="vuelo" class="form-control" id="id_vuelo" value="{{old('vuelo',$boleto->vuelo_id)}}" disabled>
                    </div>
                
                    <div class="form-group col-md-12">
                    <label for="id_llegada">Llegada</label>
                    <input type="text" name="llegada" class="form-control" id="id_llegada" value="{{old('llegada',$boleto->llegada)}}" disabled>
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