@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="aerolinea_id">Aerolinea</label>
        <select name="aerolinea_id" class="form-control">
                @foreach ($aerolineas as $aerolinea)
                    <option value="{{old('aerolinea', $aerolinea->id)}}" selected>{{$aerolinea->nombre}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="modelo_id">Modelo</label>
        <input type="text" name="modelo" class="form-control @error('modelo') is-invalid 
        @enderror" id="modelo_id" placeholder="Boeing 737" value="{{old('modelo',$avion->modelo)}}"
            onKeyUp="n_modelo_mask(this);" required>
        @error('modelo')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="fabricante_id">Fabricante</label>
        <input type="text" name="fabricante" class="form-control @error('fabricante') is-invalid 
        @enderror" id="fabricante_id" placeholder="Boeing 737" value="{{old('fabricante',$avion->fabricante)}}"
            onKeyUp="n_fabricante_mask(this);" required>
        @error('fabricante')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="capacidad_id">Capacidad</label>
        <input type="text" name="capacidad" class="form-control @error('capacidad') is-invalid 
        @enderror" id="capacidad_id" placeholder="Boeing 737" value="{{old('capacidad',$avion->capacidad)}}"
            onKeyUp="n_capacidad_mask(this);" required>
        @error('capacidad')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-danger btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>
