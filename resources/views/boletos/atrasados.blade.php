@extends('adminlte::page')

@section('title', 'Boletos')

@section('content_header')
@include('common.status')
<div class="card">
<div class="mx-3 mt-1 mb-1 pb-3">
    <div class="row mt-3">
    <h1 class="col">Boletos</h1>
    <div class="col">
        <a class="btn btn-md btn-primary float-right" href="{{route('vuelo.index')}}"><i class="fas fa-ticket"></i>
        Volver
        </a>
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
            'Pasajero',
            'N° Vuelo',
            'Llegada',
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
          @foreach($boletos as $boleto)
            <tr>          
              <td>{{$boleto->id}}</td>
              <td>{{$boleto->pasajero_id}}</td>
              <td>{{($boleto->vuelo_id)}}</td>
              <td>{{($boleto->llegada)}}</td>
              <td><nobr>
                <a href="{{route('boleto.show',$boleto->id)}}" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Ver informacion detallada"><i class="fas fa-eye"></i></a>
                <a href="{{route('boleto.edit',$boleto->id)}}" class="btn btn-outline-primary"><i class="fas fa-pen" data-toggle="tooltip" data-placement="top" title="Editar informacion"></i></a>
                <span onclick="eliminar('{{route('boleto.destroy',$boleto->id)}}');" data-toggle="modal" data-target="#DeletedModal">
                  <a  class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Eliminar vuelo"><i class="fas fa-trash"></i></a>  
                </span>
              </nobr></td></tr>
          @endforeach
        </x-adminlte-datatable>               
      </div>

      @include('common.modaldelete',
      ['modal_title'=> 'Eliminar Boleto',
      'modal_message'=>'Esta seguro que desea eliminar este Boleto?','btnTipo'=>'danger',
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