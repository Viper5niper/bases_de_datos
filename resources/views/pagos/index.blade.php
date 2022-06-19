@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
@include('common.status')
<div class="card">
<div class="mx-3 mt-1 mb-1 pb-3">
    <div class="row mt-3">
    <h1 class="col">Pagos</h1>
    <div class="col">
        <a class="btn btn-md btn-danger float-right" href="{{route('pagos.create')}}"><i class="fas fa-user-plus"></i>
        Nuevo pago
        </a>
    </div>
    </div>
</div>
</div>
<div class="row">
  <div class="col-3">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$stats['sevendayspays']}}</h3>
        <p>Ultimos {{7}} dias</p>
      </div>
      <div class="icon">
        <i class="fas fa-dollar-sign"></i>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="small-box bg-olive">
      <div class="inner">
        <h3>$ {{$stats['sevendaysincome']}}</h3>
        <p>Ingresos ultimos {{7}} dias</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill"></i>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{$stats['monthlypays']}}</h3>
        <p>Ultimos {{30}} dias</p>
      </div>
      <div class="icon">
        <i class="fas fa-dollar-sign"></i>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>$ {{$stats['monthlyincome']}}</h3>
        <p>Ingresos ultimos {{30}} dias</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill"></i>
      </div>
    </div>
  </div>
</div>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)    


@section('content')

    <div class="card pt-3 pb-3 mt-n3">
        @php
          $heads = [
            'VIN',
            'Placa',
            'Vehiculo',
            'Propietario',
            'Servicio',
            'Monto',
            'Metodo',
            'Fecha',
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
          @foreach($pagos as $pago)
            <tr>
              <td>{{$pago->ordentrabajo->vin_vehiculo}}</td>
              <td>{{$pago->ordentrabajo->placa_vehiculo}}</td>          
              <td>{{$pago->ordentrabajo->marca_vehiculo . " " . $pago->ordentrabajo->modelo_vehiculo . " " . $pago->ordentrabajo->anio_vehiculo}}
              </td>
              <td>{{$pago->ordentrabajo->propietario_vehiculo}}</td>
              <td>{{($pago->ordentrabajo->descripcion_servicio)}}</td>
              <td>{{$pago->monto}}</td>
              <td>{{($pago->metodo)}}</td>
              <td>{{($pago->created_at)}}</td>
              <td><nobr>
                <a href="{{route('ordenestrabajo.show',['ordenestrabajo' => $pago->ordentrabajo->id])}}"
                  class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Ver informacion detallada"><i
                    class="fas fa-eye"></i></a>
                <a href="{{route('pagos.edit',$pago->id)}}" class="btn btn-outline-primary"><i class="fas fa-pen" data-toggle="tooltip" data-placement="top" title="Editar informacion"></i></a>
                <span onclick="eliminar('{{route('pagos.destroy',$pago->id)}}');" data-toggle="modal" data-target="#DeletedModal">
                  <a  class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Eliminar pago"><i class="fas fa-trash"></i></a>  
                </span>
              </nobr></td></tr>
          @endforeach
        </x-adminlte-datatable>               
      </div>

      @include('common.modaldelete',
      ['modal_title'=> 'Eliminar pago',
      'modal_message'=>'Esta seguro que desea eliminar este pago?','btnTipo'=>'danger',
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