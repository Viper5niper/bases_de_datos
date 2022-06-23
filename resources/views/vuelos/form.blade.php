@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="origen_id">Origen</label>
        <select name="origen_id" class="form-control">
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{old('ubicacion', $ubicacion->id)}}" selected>{{$ubicacion->ciudad.", ".$ubicacion->pais}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="destino_id">Destino</label>
        <select name="destino_id" class="form-control">
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{old('ubicacion', $ubicacion->id)}}" selected>{{$ubicacion->ciudad.", ".$ubicacion->pais}}</option>
                @endforeach
        </select>
    </div>
    
    <div class="form-group col-md-6">
        <label for="avion_id">Avion</label>
        <select name="avion_id" class="form-control">
                @foreach ($aviones as $avion)
                    <option value="{{old('avion', $avion->id)}}" selected>{{$avion->modelo}}</option>
                @endforeach
        </select>
    </div>
    @section('plugins.DateRangePicker', true)
    @php
    $config = [
        "singleDatePicker" => true,
        "showDropdowns" => true,
        "startDate" => "js:moment()",
        "minYear" => 2000,
        "maxYear" => "js:parseInt(moment().format('YYYY'),10)",
        "timePicker" => true,
        "timePicker24Hour" => true,
        "timePickerSeconds" => true,
        "cancelButtonClasses" => "btn-danger",
        "locale" => ["format" => "YYYY-MM-DD HH:mm:ss"],
        ];
    @endphp
    <div class="form-group col-md-6">
        <x-adminlte-date-range name="despegue" label="Despegue"  :config="$config" value="{{old('aterrizaje',$vuelo->despegue)}}">
            <x-slot name="despegue">
                <div class="form-group col-md-6">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-date-range>
    </div>
    <div class="form-group col-md-6">
        <x-adminlte-date-range name="aterrizaje" label="Aterrizaje" :config="$config" value="{{old('aterrizaje',$vuelo->aterrizaje)}}">
            <x-slot name="aterrizaje">
                <div class="form-group col-md-6">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-date-range>
    </div>

    <div class="form-group col-md-6">
        <label for="id_precio">Precio</label>
        <input type="number" step="0.01" name="precio" class="form-control @error('precio') is-invalid 
        @enderror" id="id_precio" placeholder="1500" value="{{old('precio',$vuelo->precio)}}"
            onKeyUp="n_precio_mask(this);" required>
        @error('precio')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-12">
        <label for="id_recorrido">Recorrido</label>
        <input type="number" step="0.00001" name="recorrido" class="form-control @error('recorrido') is-invalid 
        @enderror" id="id_recorrido" placeholder="3691.9" value="{{old('recorrido',$vuelo->recorrido)}}"
            onKeyUp="n_recorrido_mask(this);" required>
        @error('recorrido')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-success btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>

