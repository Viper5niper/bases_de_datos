@extends('adminlte::page')

@section('title', 'Nueva Aerolinea')

@section('content_header')
@include('common.status')

  <div class="card col-lg-12 d-flex justify-content-center p-3">
    <div class="row">
      <h1 class="col">Nuevo Aerolinea</h1>
      <div class="col">
        <button class="btn btn-md btn-info float-right" onclick="introJs().start();"><i
            class="fas fa-question-circle"></i>
          Ayuda
        </button>
      </div>
      <div class="">
        <a href="{{ route('aerolinea.index') }}" class="btn btn-md btn-secondary float-right"><i
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
            <form class="form-horizontal" method="POST" action="{{ route('aerolinea.store') }}" enctype="multipart/form-data">
                @include('aerolinea.form',['btnText'=>'Registrar Aerolinea'])
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