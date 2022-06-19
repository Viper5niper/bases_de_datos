@extends('adminlte::page')

@section('title', 'Nuevo')

@section('content_header')
@include('common.status')

<div class="container">
    <div class="card col-lg-12 d-flex justify-content-center p-3">
        <div class="row">
            <h1 class="col">Nueva orden de trabajo</h1>
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
            <form id="formcrear" class="form-horizontal" method="POST" action="{{ route('ordenestrabajo.store') }}"
                enctype="multipart/form-data">
                @include('ordenestrabajo.form',['btnText'=>'Registrar Orden de Trabajo', 'nuevaOrden' => true])
                <br>
                <button onclick="crearCotizacion();" class="btn btn-info btn-block btn-lg" data-intro="Si en vez de guardar esta orden de trabajo desea solo cotizarla, puede hacerlo presionando este boton."><span>Crear Cotizacion</span></button>
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
<script type="application/javascript">
function crearCotizacion(){
    
var form = document.getElementById( 'formcrear' );  //tomamos el form de creacion
var elements = form.elements;   //tomamos todos sus elementos

//console.log(elements);

//recorremos cada uno
for (var i = 0, element; element = elements[i++];) {
    if (element.hasAttribute('required'))   //si tiene el atributo required se lo quitamos
        element.removeAttribute('required');
}

form.action='{{ route('ordenestrabajo.cotizar') }}';
form.submit();
//el backend nos indicara si un campo obligatorio hace falta. Aca solo hacemos posible enviar el formulario saltandonos todos los requisitos obligatorios

}

</script>
<script src="https://unpkg.com/imask"></script>
<script src="/js/utilities.js"></script>
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
@stop