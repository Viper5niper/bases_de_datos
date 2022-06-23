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
            <a class="btn btn-md btn-primary float-right" href="#">
                GENERAR DATA WAREHOUSE
            </a>
    </div>

    <div class="form-group col-md-5">
            <a class="btn btn-md btn-primary float-right" href="#">
                GUARDAR
            </a>
    </div>

    <div class="form-group col-md-5 offset-1">
          <label for="tabla">Tablas</label>
            <select class="form-control" name="tabla">
              <option value="1">Tabla1</option>
              <option value="2">Tabla2</option>
              <option value="3">Tabla3</option>
            </select>
    </div>

    <div class="form-group col-md-5">
            <label for="formFile" class="form-label">Subir Archivo</label>
            <input class="form-control" type="file" id="formFile">
    </div>
</div>
</div>









@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

