<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Imprimir Orden de trabajo</title>
</head>

<body>

  <div class="">
    <div class="row">
      <div class="col-lg-12 card d-flex justify-content-center mx-auto p-5">
        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">

          <div class="form-row">

            <div class="container row" data-intro='En este apartado veremos al cliente que trajo el vehiculo al taller'>

              <h3 class="col-md-12 text-center">Cliente</h3>
              <div class="form-group col-md-9"
                data-intro='Podemos ver que el nombre esta bloqueado. Esto es porque nosotros ya elegimos con anterioridad al cliente, asi que sus datos solo se muestran para corroborar'>
                <label for="ot_vin_vehiculo">Nombre del Cliente</label>
                <input type="text" class="form-control" id="ot_vin_vehiculo" value="{{old('nombre',$cliente->nombre)}}"
                  disabled>
              </div>

              <div class="form-group col-md-3" data-intro='Igualmente ocurre con el telefono'>
                <label for="ot_vin_vehiculo">Telefono del Cliente</label>
                <input type="text" class="form-control" id="ot_vin_vehiculo"
                  value="{{old('telefono',$cliente->telefono)}}" disabled>
              </div>

              <input type="number" hidden name="cliente_id" value="{{$cliente->id}}">
            </div>

            <div class="container row"
              data-intro='En este apartado ingresaremos el vehiculo con sus respectivos datos. Todos los campos son obligatorios. Si falta uno, el sistema no dejara ingresar la orden de trabajo.'>

              <h3 class="col-md-12 text-center my-4">Vehiculo</h3>

              <div class="form-group col-md-6">
                <label for="id_propietario_vehiculo">Nombre del Propietario</label>
                <input type="text" name="propietario_vehiculo" class="form-control" id="id_propietario_vehiculo"
                  value="{{old('propietario_vehiculo',$ordentrabajo->propietario_vehiculo)}}" disabled>
              </div>

              <div class="form-group col-md-3">
                <label for="id_vin_vehiculo">VIN</label>
                <input type="text" name="vin_vehiculo" class="form-control" id="id_vin_vehiculo"
                  value="{{old('vin_vehiculo',$ordentrabajo->vin_vehiculo)}}" disabled>
              </div>

              <div class="form-group col-md-3">
                <label for="id_placa_vehiculo">Placa</label>
                <input type="text" name="placa_vehiculo" class="form-control" id="id_placa_vehiculo"
                  value="{{old('placa_vehiculo',$ordentrabajo->placa_vehiculo)}}" disabled>
              </div>

              <div class="form-group col-md-2">
                <label for="id_anio">Anio</label>
                <input type="number" min="1900" max="2100" name="anio_vehiculo" class="form-control @error('anio_vehiculo') is-invalid 
                            @enderror" id="id_anio" value="{{old('anio_vehiculo',$ordentrabajo->anio_vehiculo)}}"
                  onKeyUp="" disabled>
              </div>

              <div class="form-group col-md-3">
                <label for="id_marca">Marca</label>
                <input type="text" name="marca_vehiculo" class="form-control @error('marca_vehiculo') is-invalid 
                            @enderror" id="id_marca" value="{{old('marca_vehiculo',$ordentrabajo->marca_vehiculo)}}"
                  disabled>
              </div>

              <div class="form-group col-md-3">
                <label for="id_modelo">Modelo</label>
                <input type="text" name="modelo_vehiculo" class="form-control @error('modelo_vehiculo') is-invalid 
                            @enderror" id="id_modelo" value="{{old('modelo_vehiculo',$ordentrabajo->modelo_vehiculo)}}"
                  disabled>
              </div>

              <div class="form-group col-md-2">
                <label for="id_kilometraje">Kilometraje</label>
                <input type="number" name="kilometraje_vehiculo" class="form-control" id="id_kilometraje"
                  value="{{old('kilometraje_vehiculo',$ordentrabajo->kilometraje_vehiculo)}}" disabled>
              </div>

              <div class="form-group col-md-2">
                <label for="id_millaje">Millaje</label>
                <input type="number" class="form-control" id="id_millaje"
                  value="{{ceil((int) old('kilometraje_vehiculo',$ordentrabajo->kilometraje_vehiculo) / 1.609)}}"
                  disabled>
              </div>

              <input type="hidden" id="kms" name="kilometraje_vehiculo" value="1" type="number">

            </div> <!-- fin container row -->

            <div class="container row" data-intro='Aca detallaremos el servicio que se hizo al vehiculo.'>

              <h3 class="col-md-12 text-center my-4">Detalle del Servicio</h3>

              <div class="form-group col-md-6">
                <label for="id_desc">Describa el servicio brindado</label>
                <input type="text" name="descripcion_servicio" class="form-control" id="id_desc"
                  value="{{old('descripcion_servicio',$ordentrabajo->descripcion_servicio)}}" disabled>
              </div>

              <div class="form-group col-md-3" data-intro='Para elegir una fecha, presionamos el icono de calendario.'>
                <label for="id_entrada">Fecha de recepcion</label>
                <input type="text" name="fecha_entrada" class="form-control" id="id_entrada"
                  value="{{old('fecha_entrada',$ordentrabajo->fecha_entrada->format('Y-m-d'))}}" disabled>
              </div>

              <div class="form-group col-md-3">
                <label for="id_salida">Fecha de entrega</label>
                <input type="text" name="fecha_salida" class="form-control" id="id_salida"
                  value="{{old('fecha_salida',$ordentrabajo->fecha_salida->format('Y-m-d'))}}" disabled>
              </div>

              <div class="form-group col-md-12"
                data-intro='Puede estirar este campo haciendo clic derecho en la esquina inferior derecha y arrastrando.'>
                <label for="id_observaciones">Observaciones</label>
                <textarea type="text" name="observacion_servicio" class="form-control" id="id_observaciones"
                  disabled>{{old('observacion_servicio',$ordentrabajo->observacion_servicio)}}</textarea>
              </div>

            </div> <!-- fin container row -->

            @include('ordenestrabajo.tablacotizdisabled')

            <div class="container row">

              <div class="form-group col-md-8">
                <label for="id_encargado">Encargado del servicio</label>
                <input type="text" name="tecnico_encargado" class="form-control" id="id_encargado"
                  value="{{old('tecnico_encargado',$ordentrabajo->tecnico_encargado)}}" disabled>
              </div>

              <div class="form-group col-md-4"
                data-intro='Al ingresar esta fecha, el sistema le indicara en dicha fecha que este cliente requiere de un servicio a su vehiculo para que se comunique con el.'>
                <label for="id_proximo">Proximo servicio</label>
                <input type="text" name="proximo_servicio" class="form-control" id="id_proximo"
                  value="{{$ordentrabajo->proximo_servicio ? $ordentrabajo->proximo_servicio->format('Y-m-d') : 'no se especifico un proximo servicio'}}"
                  disabled>
              </div>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>