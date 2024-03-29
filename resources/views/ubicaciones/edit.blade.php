@extends('adminlte::page')

@section('title', 'Editar Ubicacion')

@section('content_header')
@include('common.status')

  <div class="card col-lg-12 d-flex justify-content-center p-3">
    <div class="row">
      <h1 class="col">Editar Ubicacion</h1>
      <div class="col">
        <button class="btn btn-md btn-info float-right" onclick="introJs().start();"><i
            class="fas fa-question-circle"></i>
          Ayuda
        </button>
      </div>
      <div class="">
        <a href="{{ route('ubicacion.index') }}" class="btn btn-md btn-secondary float-right"><i
            class="fas fa-arrow-left"></i>
          Volver
        </a>
      </div>
    </div>
  </div>

@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 card d-flex justify-content-center mx-auto p-5">       
            <form class="form-horizontal" method="POST" action="{{ route('ubicacion.update',$ubicacion->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @include('ubicaciones.form',['btnText'=>'Guardar Cambios'])
            </form>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://unpkg.com/imask"></script>
    <script src="/js/utilities.js"></script>
@stop