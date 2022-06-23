@extends('adminlte::page')

@section('title', 'Nuevo Pasajero')

@section('content_header')
@include('common.status')

  <div class="card col-lg-12 d-flex justify-content-center p-3">
    <div class="row">
      <h1 class="col">Nuevo Pasajero</h1>
      <div class="col">
        <a href="{{ route('pasajeros.index') }}" class="btn btn-md btn-secondary float-right"><i
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
            <form class="form-horizontal" method="POST" action="{{ route('pasajeros.store') }}" enctype="multipart/form-data">
                @include('pasajeros.form',['btnText'=>'Registrar pasajero'])
            </form>
        </div>
    </div>
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://unpkg.com/imask"></script>
    <script src="/js/utilities.js"></script>
@stop