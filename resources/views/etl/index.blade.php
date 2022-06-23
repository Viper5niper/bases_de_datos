@extends('adminlte::page')

@section('title', 'Aerolinea')

@section('content_header')
@include('common.status')
<div class="card">
  <div class="mx-3 mt-1 mb-1 pb-3">
      <div class="row mt-3">
      <h1 class="col">ETL</h1>
      <div class="col">
        <a href="{{ route('etl.index') }}" class="btn btn-md btn-secondary float-right"><i
            class="fas fa-arrow-left"></i>
          Volver
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

<div class="card">
<div class="form-row mt-3">
    <div class="form-group col-md-3">
            <a class="btn btn-md btn-primary float-right" href="{{ route('etl.datawarehouse') }}">
                GENERAR DATA WAREHOUSE
            </a>
    </div>

    <div class="form-group col-md-5">
            <a class="btn btn-md btn-primary float-right" href="{{ route('etl.etl_base') }}">
                GENERAR UBICACIONES A PARTIR DE CSV
            </a>
    </div>

</div>
</div>









@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

