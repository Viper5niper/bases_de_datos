@csrf
<div class="form-row">

  @if($errors->any())
  <ul>
    {!! implode('', $errors->all('<li><b>:message</b></li>')) !!}
  </ul>
@endif

  @include('ordenestrabajo.formcliente')

  <div class="container row"
    data-intro='En este apartado ingresaremos el vehiculo con sus respectivos datos. Los campos VIN y Placa son opcionales, pero debera ingresar al menos uno de estos'>

    <h3 class="col-md-12 text-center my-4">Vehiculo</h3>

    <div class="form-group col-md-6">
      <label for="id_propietario_vehiculo">Nombre del Propietario</label>
      <input type="text" name="propietario_vehiculo" class="form-control @error('propietario_vehiculo') is-invalid 
        @enderror" id="id_propietario_vehiculo" placeholder="Rogelio Salmeron"
        value="{{old('propietario_vehiculo',$ordentrabajo->propietario_vehiculo)}}" onKeyUp="toUpperCaseField(this);"
        required>
      @error('propietario_vehiculo')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-3">
      <label for="id_vin_vehiculo">VIN</label>
      <input type="text" name="vin_vehiculo" class="form-control @error('vin_vehiculo') is-invalid 
        @enderror" id="id_vin_vehiculo" placeholder="AS3554ASD564FASD3" maxlength="17"
        value="{{old('vin_vehiculo',$ordentrabajo->vin_vehiculo)}}" onKeyUp="toUpperCaseField(this);vinplaca();" required>
      @error('vin_vehiculo')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-3">
      <label for="id_placa_vehiculo">Placa</label>
      <input type="text" name="placa_vehiculo" class="form-control @error('placa_vehiculo') is-invalid 
        @enderror" id="id_placa_vehiculo" placeholder="P00000"
        value="{{old('placa_vehiculo',$ordentrabajo->placa_vehiculo)}}"
        onKeyUp="toUpperCaseField(this);n_placa_mask(this);vinplaca();" required>
      @error('placa_vehiculo')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-2">
      <label for="id_anio">Año</label>
      <input type="number" min="1900" max="2100" name="anio_vehiculo" class="form-control @error('anio_vehiculo') is-invalid 
        @enderror" id="id_anio" placeholder="2022" value="{{old('anio_vehiculo',$ordentrabajo->anio_vehiculo)}}"
        onKeyUp="" required>
      @error('anio_vehiculo')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-3">
      <label for="id_marca">Marca</label>
      <input type="text" name="marca_vehiculo" class="form-control @error('marca_vehiculo') is-invalid 
        @enderror" id="id_marca" placeholder="Nissan" value="{{old('marca_vehiculo',$ordentrabajo->marca_vehiculo)}}"
        onKeyUp="toUpperCaseField(this);" required>
      @error('marca_vehiculo')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-3">
      <label for="id_modelo">Modelo</label>
      <input type="text" name="modelo_vehiculo" class="form-control @error('modelo_vehiculo') is-invalid 
        @enderror" id="id_modelo" placeholder="Frontier"
        value="{{old('modelo_vehiculo',$ordentrabajo->modelo_vehiculo)}}" onKeyUp="toUpperCaseField(this);" required>
      @error('modelo_vehiculo')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-4" data-intro='En este campo ingresara el kilometraje.'>
      <label for="id_odometro">Odometro</label>
      <div class="input-group">

        <input type="number" name="kilometraje_vehiculo" min="0" max="1000000" class="form-control @error('kilometraje_vehiculo') is-invalid
        @enderror" id="id_odometro" placeholder="200000"
          value="{{old('kilometraje_vehiculo',$ordentrabajo->kilometraje_vehiculo)}}" required>
        <div class="input-group-append">
          <button id="millaskm" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"
            data-intro='Si desea ingresar el dato en millas, presione este boton, donde podra elegir entre millas y kilometros'>{{old('unidad_vehiculo') ?? $ordentrabajo->unidad_vehiculo ?? 'Km'}}</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" onclick="label_millaskm(false)">Millas</a>
            <a class="dropdown-item" onclick="label_millaskm(true)">Kilometros</a>
          </div>
        </div>
        @error('kilometraje_vehiculo')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <input type="hidden" id="kms" name="unidad_vehiculo" value="{{old('unidad_vehiculo') ?? $ordentrabajo->unidad_vehiculo ?? 'Km'}}">

  </div> <!-- fin container row -->

  <div class="container row" data-intro='Aca detallaremos el servicio que se hizo al vehiculo.'>

    <h3 class="col-md-12 text-center my-4">Detalle del Servicio</h3>

    <div class="form-group col-md-6">
      <label for="id_desc">Describa el servicio brindado</label>
      <input type="text" name="descripcion_servicio" class="form-control @error('descripcion_servicio') is-invalid 
        @enderror" id="id_desc" placeholder="Cambio de aceite de motor"
        value="{{old('descripcion_servicio',$ordentrabajo->descripcion_servicio)}}" onKeyUp="toUpperCaseField(this);"
        required>
      @error('descripcion_servicio')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-3" data-intro='Para elegir una fecha, presionamos el icono de calendario.'>
      <label for="id_entrada">Fecha de recepcion</label>
      <input type="date" name="fecha_entrada" class="form-control @error('fecha_entrada') is-invalid 
        @enderror" id="id_entrada"
        value="{{$ordentrabajo->fecha_entrada ? $ordentrabajo->fecha_entrada->format('Y-m-d') : null}}" required>
      @error('fecha_entrada')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-3">
      <label for="id_salida">Fecha de entrega</label>
      <input type="date" name="fecha_salida" class="form-control @error('fecha_salida') is-invalid 
        @enderror" id="id_salida"
        value="{{$ordentrabajo->fecha_salida ? $ordentrabajo->fecha_salida->format('Y-m-d') : null}}" required>
      @error('fecha_salida')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="form-group col-md-12"
      data-intro='Puede estirar este campo haciendo clic derecho en la esquina inferior derecha y arrastrando.'>
      <label for="id_trabajorealizado">Trabajo realizado</label>
      <textarea type="text" name="trabajo_realizado" class="form-control @error('trabajo_realizado') is-invalid 
        @enderror" id="id_trabajorealizado" placeholder="Detalle de mano de obra"
        onKeyUp="toUpperCaseField(this);">{{old('trabajo_realizado',$ordentrabajo->trabajo_realizado)}}</textarea>
      @error('trabajo_realizado')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-8"
      data-intro='Tambien puede estirar este campo haciendo clic derecho en la esquina inferior derecha y arrastrando.'>
      <label for="id_observaciones">Observaciones</label>
      <textarea type="text" name="observacion_servicio" class="form-control @error('observacion_servicio') is-invalid 
        @enderror" id="id_observaciones" placeholder="Cliente no hizo cambio de flitro de aceite"
        onKeyUp="toUpperCaseField(this);">{{old('observacion_servicio',$ordentrabajo->observacion_servicio)}}</textarea>
      @error('observacion_servicio')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-4"
      data-intro='Al hacer clic a este campo, se abrira explorador de archivos. Podemos elegir una imagen haciendo clic, o seleccionar varias apretando shift + clic sobre cada imagen, o bien sombreando las imagenes deseadas.'>
      <label for="id_images">Fotografias</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="id_images" name="images[]" multiple>
          <label class="custom-file-label" for="id_images">Choose file</label>
        </div>
      </div>
    </div>

  </div> <!-- fin container row -->

  @include('ordenestrabajo.tablacotiz')

  <div class="form-group col-md-8">
    <label for="id_encargado">Encargado del servicio</label>
    <input type="text" name="tecnico_encargado" class="form-control @error('tecnico_encargado') is-invalid 
        @enderror" id="id_encargado" placeholder="Pedro Hernandez"
      value="{{old('tecnico_encargado',$ordentrabajo->tecnico_encargado)}}" onKeyUp="toUpperCaseField(this);" required>
    @error('tecnico_encargado')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group col-md-4"
    data-intro='Al ingresar esta fecha, el sistema le indicara en dicha fecha que este cliente requiere de un servicio a su vehiculo para que se comunique con el.'>
    <label for="id_proximo">Proximo servicio (opcional)</label>
    <input type="date" name="proximo_servicio" class="form-control @error('proximo_servicio') is-invalid 
        @enderror" id="id_proximo"
      value="{{$ordentrabajo->proximo_servicio ? $ordentrabajo->proximo_servicio->format('Y-m-d') : null}}">
    @error('proximo_servicio')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>


  <div class="form-button col-md-12"
    data-intro='Cuando todo este en orden, damos click en este boton para guardar la orden de trabajo'>
    <button type="submit" class="btn btn-danger btn-block btn-lg"><span>{{$btnText}}</span></button>
  </div>

</div>
<script src="vendor/bs-custom-file-input.min.js"></script>
<script type="application/javascript">
  document.addEventListener("DOMContentLoaded", function(event) {
      vinplaca();
      
  //$("#id_proximo").datepicker("update", '{{old("proximo_servicio",$ordentrabajo->proximo_servicio)}}');
});

//   function setKilometraje(){
//     kms = document.getElementById("kms");
//     btn = document.getElementById('millaskm');
//     odo = document.getElementById('id_odometro');
//     let multip = 1;
//     if(btn.innerHTML == "Mi") multip = 1.609344;

//     kms.value = Math.round(odo.value * multip);

//     console.log(kms.value);
//   }

  function label_millaskm(km){
    kms = document.getElementById("kms");
    btn = document.getElementById('millaskm');
    km ? btn.innerHTML = "Km" : btn.innerHTML = "Mi";
    km ? kms.value = "Km" : kms.value = "Mi";

    //setKilometraje();
  }
    
  function vinplaca(){
    vin = document.getElementById("id_vin_vehiculo");
    placa = document.getElementById('id_placa_vehiculo');

    if(vin.value != ""){ placa.removeAttribute("required"); }  //si ya se ingreso el vin, la placa es requerida
    if(placa.value != ""){ vin.removeAttribute("required"); }
    if(vin.value == "" && placa.value == ""){
    vin.setAttribute("required",true);  //si tanto este como la placa estan vacios, ambos son requeridos  
    placa.setAttribute("required",true); //si tanto este como la placa estan vacios, ambos son requeridos
    } 
  }
  
  function toUpperCaseField(e) {
    e.value = e.value.toUpperCase();
  }

  function n_placa_mask(e) {
    var maskOptions = {
    mask: /^[a-z]{1}[0-9a-f]{0,6}$/i
    };
    var mask = IMask(e, maskOptions);
  }

  function money_mask(e){
    
    var numberMask = IMask(e, {
        mask:'$num',
        blocks:{
            num:{
                // other options are optional with defaults below
        scale: 2,  // digits after point, 0 for integers
        signed: false,  // disallow negative
        thousandsSeparator: '',  // any single char
        padFractionalZeros: false,  // if true, then pads zeros at end to the length of scale
        normalizeZeros: true,  // appends or removes zeros at ends
        radix: '.',  // fractional delimiter
        mapToRadix: ['.'],  // symbols to process as radix
        max: 1000000
            }
        }
        
      });
    
}
</script>

<script type="text/javascript">
  $(document).ready(function () {
    
  });
  </script>