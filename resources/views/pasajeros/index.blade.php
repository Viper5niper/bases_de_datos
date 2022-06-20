@extends('adminlte::page')

@section('title', 'Pasajeros')

@section('content_header')
@include('common.status')
<div class="card">
<div class="mx-3 mt-1 mb-1 pb-3">
    <div class="row mt-3">
    <h1 class="col">Pasajero</h1>
    <div class="col">
        <a class="btn btn-md btn-danger float-right" href="{{route('pasajero.create')}}"><i class="fas fa-plane"></i>
          Nuevo Pasajero
        </a>
    </div>
    </div>
</div>
</div>

<!--

 -->
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)    


@section('content')

    <div class="col-lg-12 card pt-3 pb-3 mt-n3">
        @php
          $heads = [
            'ID',
            'Nombre Pasajero',
            ['label' => 'Acciones', 'no-export' => true],
          ];
          $config = [
            'language' => [
                  "url" => "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json",
                  "paginate" => [
                  "next" => '»',
                  "previous" => '«'
                  ],
            ],
            'order' => [[1, 'asc']],
          ];
        @endphp

        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="light" striped hoverable beautify with-buttons>                
          @foreach($pasajero as $pasajeros)
            <tr>          
              <td>{{$pasajeros->id}}</td>
              <td>{{$pasajeros->nombre}}</td>
              <td>{{$pasajeros->apellido}}</td>
              <td>{{$pasajeros->genero}}</td>
              <td>{{$pasajeros->ubicacion}}</td>
              <td>{{$pasajeros->fecha_nacimiento}}</td>
              <td><nobr>
                <a href="{{route('pasajeros.show',$pasajeros->id)}}" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Ver informacion detallada"><i class="fas fa-eye"></i></a>
                <a href="{{route('pasajeros.edit',$pasajeros->id)}}" class="btn btn-outline-primary"><i class="fas fa-pen" data-toggle="tooltip" data-placement="top" title="Editar informacion"></i></a>
                <span onclick="eliminar('{{route('pasajero.destroy',$pasajeros->id)}}');" data-toggle="modal" data-target="#DeletedModal">
                  <a  class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Pasajero"><i class="fas fa-trash"></i></a>  
                </span>
              </nobr></td></tr>
          @endforeach
        </x-adminlte-datatable>

      </div>

      @include('common.modaldelete',
      ['modal_title'=> 'Eliminar Aerolinea',
      'modal_message'=>'Esta seguro que desea eliminar Aerolinea?','btnTipo'=>'danger',
      'ruta'=>''])
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://unpkg.com/imask"></script>
<script src="/js/utilities.js"></script>
<script type="application/javascript">
  function eliminar(e){
    //console.log(e);
    let form = document.getElementById('form-delete');
    form.setAttribute("action",e);
  }
</script>
@stop