@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
@include('common.status')
<div class="card">
<div class="mx-3 mt-1 mb-1 pb-3">
    <div class="row mt-3">
    <h1 class="col">Clientes</h1>
    <div class="col">
        <a class="btn btn-md btn-primary float-right" href="{{route('clientes.create')}}"><i class="fas fa-user-plus"></i>
        Nuevo Cliente
        </a>
    </div>
    </div>
</div>
</div>
<div class="row">
  <div class="col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$stats['sevendays']}}</h3>
        <p>Nuevos clientes</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-check"></i>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="small-box bg-success" onclick="window.open('{{route('ordenestrabajo.contact')}}','_self')">
      <div class="inner">
        <h3>{{$stats['nearcalls']}}</h3>
        <p>Mantenimientos proximos</p>
      </div>
      <div class="icon">
        <i class="fas fa-phone"></i>
      </div>
    </div>
  </div>
</div>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)    


@section('content')

    <div class="col-lg-12 card pt-3 pb-3 mt-n3">
        @php
          $heads = [
            'ID',
            'Nombre Cliente',
            'Telefono',
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
          @foreach($clientes as $cliente)
            <tr>          
              <td>{{$cliente->id}}</td>
              <td>{{$cliente->nombre}}</td>
              <td>{{($cliente->telefono)}}</td>
              <td><nobr>
                <a href="{{route('ordenestrabajo.create',['idc' => $cliente->id])}}" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Registrar un trabajo"><i class="fas fa-hammer"></i></a>
                <a href="{{route('clientes.show',$cliente->id)}}" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Ver informacion detallada"><i class="fas fa-eye"></i></a>
                <a href="{{route('clientes.edit',$cliente->id)}}" class="btn btn-outline-primary"><i class="fas fa-pen" data-toggle="tooltip" data-placement="top" title="Editar informacion"></i></a>
                <span onclick="eliminar('{{route('clientes.destroy',$cliente->id)}}');" data-toggle="modal" data-target="#DeletedModal">
                  <a  class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Eliminar cliente"><i class="fas fa-trash"></i></a>  
                </span>
              </nobr></td></tr>
          @endforeach
        </x-adminlte-datatable>               
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
<script src="/js/utilities.js"></script>
<script type="application/javascript">
  function eliminar(e){
    //console.log(e);
    let form = document.getElementById('form-delete');
    form.setAttribute("action",e);
  }
</script>
@stop