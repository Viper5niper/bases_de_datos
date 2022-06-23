@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="pasajero_id">Pasajero</label>
        <select name="pasajero_id" class="form-control">
                @foreach ($pasajeros as $pasajero)
                    <option value="{{old('pasajero', $pasajero->id)}}" selected>{{$pasajero->nombre.' '.$pasajero->apellido}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="vuelo_id">N° Vuelo</label>
        <select name="vuelo_id" class="form-control">
                @foreach ($vuelos as $vuelo)
                    <option value="{{old('vuelo', $vuelo->id)}}" selected>{{$vuelo->id}}</option>
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

    <div class="form-group col-md-12">
        <x-adminlte-date-range name="llegada" label="Llegada"  :config="$config" value="{{old('llegada',$boleto->llegada)}}">
            <x-slot name="llegada">
                <div class="form-group col-md-6">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-date-range>
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-success btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>