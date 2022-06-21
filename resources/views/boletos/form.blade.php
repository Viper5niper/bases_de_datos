@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="pasajero_id">Pasajero</label>
        <select name="pasajero_id" class="form-control">
                @foreach ($pasajeros as $pasajero)
                    <option value="{{old('pasajero', $pasajero->id)}}" selected>{{$pasajero->id}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="vuelo_id">Vuelo</label>
        <select name="vuelo_id" class="form-control">
                @foreach ($vuelos as $vuelo)
                    <option value="{{old('vuelo', $vuelo->id)}}" selected>{{$vuelo->id}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group col-md-12">
        <label for="id_llegada">Llegada</label>
        <input type="text" name="llegada" class="form-control @error('llegada') is-invalid 
        @enderror" id="id_llegada" placeholder="30/06/2022 07:00:00" value="{{old('llegada',$boleto->llegada)}}"
            onKeyUp="n_llegada_mask(this);" required>
        @error('llegada')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-danger btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>