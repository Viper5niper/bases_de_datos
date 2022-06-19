@csrf
<div class="form-row">

      @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif

    <div class="container row">

        <h3 class="col-md-12 text-center my-4">Vehiculo</h3>

        @if($ordentrabajo->id)

        <div class="form-group col-md-6">
            <label for="id_propietario_vehiculo">Nombre del Propietario</label>
            <input type="text" name="propietario_vehiculo" class="form-control" id="id_propietario_vehiculo"
                value="{{$ordentrabajo->propietario_vehiculo}}" disabled>
        </div>

        <div class="form-group col-md-3">
            <label for="id_vin_vehiculo">VIN</label>
            <input type="text" name="vin_vehiculo" class="form-control" id="id_vin_vehiculo"
                value="{{$ordentrabajo->vin_vehiculo}}" disabled>
        </div>

        <div class="form-group col-md-3">
            <label for="id_placa_vehiculo">Placa</label>
            <input type="text" name="placa_vehiculo" class="form-control" id="id_placa_vehiculo"
                value="{{$ordentrabajo->placa_vehiculo}}" disabled>
        </div>

        <div class="form-group col-md-2">
            <label for="id_anio">Anio</label>
            <input type="number" min="1900" max="2100" name="anio_vehiculo" class="form-control" id="id_anio"
                value="{{$ordentrabajo->anio_vehiculo}}" onKeyUp="" disabled>
        </div>

        <div class="form-group col-md-3">
            <label for="id_marca">Marca</label>
            <input type="text" name="marca_vehiculo" class="form-control @error('marca_vehiculo') is-invalid 
                      @enderror" id="id_marca" value="{{$ordentrabajo->marca_vehiculo}}" disabled>
        </div>

        <div class="form-group col-md-3">
            <label for="id_modelo">Modelo</label>
            <input type="text" name="modelo_vehiculo" class="form-control @error('modelo_vehiculo') is-invalid 
                      @enderror" id="id_modelo" value="{{$ordentrabajo->modelo_vehiculo}}" disabled>
        </div>

        <div class="form-group col-md-2">
            <label for="id_kilometraje">Kilometraje</label>
            <input type="number" name="kilometraje_vehiculo" class="form-control" id="id_kilometraje"
                value="{{$ordentrabajo->kilometraje_vehiculo}}" disabled>
        </div>

        <div class="form-group col-md-2">
            <label for="id_millaje">Millaje</label>
            <input type="number" class="form-control" id="id_millaje"
                value="{{ceil((int) $ordentrabajo->kilometraje_vehiculo) / 1.609344}}" disabled>
        </div>

        @else

        <a href="{{route('ordenestrabajo.pay')}}" onclick="window.open(this.href, 'mywin',
'left=20,
top=20,
width=1000,
height=500,
toolbar=1,
resizable=0');
return false;" class="btn btn-info col-md-12 my-2" type="button"
            data-intro='Para elegir un cliente, presionamos este boton. Una vez elegido el cliente se mostrara aca.'>
            Buscar Orden de Trabajo</a>

        @error('ordentrabajo_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @endif

    </div> <!-- fin container row -->

    <div class="container row">

        <h3 class="col-md-12 text-center my-4">Pago</h3>

        <div class="form-group col-md-2" data-intro=''>
            <label for="id_total">Total a pagar</label>
            <input type="number" class="form-control" id="id_total" placeholder="$" disabled value="{{$ordentrabajo->monto_servicio}}">
        </div>

        <div class="form-group col-md-2" data-intro=''>
            <label for="id_cancelado">Total cancelado</label>
            <input type="number" step="0.01" class="form-control" id="id_cancelado" placeholder="$" disabled value="{{$ordentrabajo->cancelado_servicio}}">
        </div>

        <div class="form-group col-md-2">
            <label for="id_monto">Pago actual</label>
            <input type="number" name="monto" step="0.01" class="form-control @error('monto') is-invalid 
        @enderror" id="id_monto" placeholder="$" value="{{old('monto',$pago->monto)}}"
                onKeyUp="calcRestante();" required>
            @error('monto')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-md-2" data-intro='Este campo se calcula solo al haber ingresado el monto y la cantidad pagada por el cliente.'>
            <label for="id_restante">Restante</label>
            <input type="number" step="0.01" class="form-control" id="id_restante" placeholder="$" disabled value="{{$ordentrabajo->monto_servicio - $ordentrabajo->cancelado_servicio}}">
        </div>

        <div class="form-group col-md-4"
            data-intro='Aca puede elegir entre los diferentes medios de pago disponibles.'>
            <label for="id_metodo">Medio de pago</label>
            <select id="id_metodo" name="metodo" class="custom-select" aria-label="Default select example" value="{{old('metodo',$pago->metodo)}}">
                <option value="Efectivo" selected>Efectivo</option>
                <option value="Transferencia bancaria">Transferencia bancaria</option>
                <option value="Tarjeta de debito / credito">Tarjeta de debito / credito</option>
            </select>
        </div>

        <input type="number" hidden name="ordentrabajo_id" value="{{$ordentrabajo->id}}">

    </div> <!-- fin container row -->

    <div class="form-button pt-4 col-md-12"> <button type="submit"
            class="btn btn-danger btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>

<script type="application/javascript">
    function calcRestante(){
    let monto = parseFloat($('#id_total').val()) - parseFloat($('#id_cancelado').val());
    let pagado = parseFloat($('#id_monto').val());
    let restante = monto - pagado;
    $('#id_restante').val(restante);

    if( pagado > monto ){
        $('#id_restante').val("");
        $('#id_monto').val("");
        calcRestante();
        }
}
</script>