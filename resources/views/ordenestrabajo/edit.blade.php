@extends('adminlte::page')

@section('title', 'Editar Orden de Trabajo')

@section('content_header')
@include('common.status')

<div class="container">
    <div class="card col-lg-12 d-flex justify-content-center p-3">
        <div class="row">
            <h1 class="col">Editar orden de trabajo</h1>
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
</div>
@stop

@section('content')

@if($errors->any())
<x-adminlte-alert theme="warning" title="Error en los datos" dismissable>
    Por favor revise los datos ingresados en el formulario
</x-adminlte-alert>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-12 card d-flex justify-content-center mx-auto p-5">
            <form class="form-horizontal" method="POST"
                action="{{ route('ordenestrabajo.update',['ordenestrabajo' => $ordentrabajo->id]) }}"
                enctype="multipart/form-data">
                @method('PATCH')
                @include('ordenestrabajo.form',['btnText'=>'Guardar cambios', 'nuevaOrden' => false])
            </form>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
@stop

@section('js')
<script src="https://unpkg.com/imask"></script>
<script src="/js/utilities.js"></script>
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
@stop