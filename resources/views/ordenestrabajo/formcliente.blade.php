<div class="container row" data-intro='En este apartado veremos al cliente que trajo el vehiculo al taller'>

    <h3 class="col-md-12 text-center">Cliente</h3>

    @error('cliente_id')
    <x-adminlte-alert class="col-md-12" theme="danger" title="Error" dismissable>
        Por favor elija un cliente
    </x-adminlte-alert>
    @enderror

    @if($cliente->id)
    <div class="form-group col-md-9"
        data-intro='Podemos ver que el nombre esta bloqueado. Esto es porque nosotros ya elegimos con anterioridad al cliente, asi que sus datos solo se muestran para corroborar'>
        <label for="ot_vin_vehiculo">Nombre del Cliente</label>
        <input type="text" class="form-control" id="ot_vin_vehiculo" value="{{old('nombre',$cliente->nombre)}}"
            disabled>
    </div>

    <div class="form-group col-md-3" data-intro='Igualmente ocurre con el telefono'>
        <label for="ot_vin_vehiculo">Telefono del Cliente</label>
        <input type="text" class="form-control" id="ot_vin_vehiculo" value="{{old('telefono',$cliente->telefono)}}"
            disabled>
    </div>

    @if($nuevaOrden)
    <a href="{{route('clientes.search')}}" onclick="window.open(this.href, 'mywin',
    'left=20,
    top=20,
    width=1000,
    height=500,
    toolbar=1,
    resizable=0');
    return false;" class="btn btn-info col-md-12" type="button"
        data-intro='Si deseamos buscar otro cliente, presionamos este boton'>
        Buscar Otro Cliente</a>
    @else

    <input type="hidden" name="contactado" value="0" />

    <div class="form-group col-md-9 offset-md-3" data-intro='Desde aca, podemos establecer el cliente como contactado o no contactado haciendo clic en el check'>
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" name="contactado" type="checkbox" id="id_contactado" {{old('contactado',$ordentrabajo->contactado) ? "checked" : null}} onclick="this.value = this.checked ? 1 : 0" value="{{old('contactado',$ordentrabajo->contactado)}}">
            <label for="id_contactado" class="custom-control-label">El cliente ha sido contactado para su proximo mantenimiento</label>
        </div>
    </div>

    @endif

    <input type="number" hidden name="cliente_id" value="{{$cliente->id}}">
    @else
    <a href="{{route('clientes.search')}}" onclick="window.open(this.href, 'mywin',
'left=20,
top=20,
width=1000,
height=500,
toolbar=1,
resizable=0');
return false;" class="btn btn-info col-md-12 my-2" type="button"
        data-intro='Para elegir un cliente, presionamos este boton. Una vez elegido el cliente se mostrara aca.'>
        Buscar Cliente</a>
    @error('cliente_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <input type="hidden" name="cliente_id" required>
    @endif
</div>