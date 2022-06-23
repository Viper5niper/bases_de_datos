@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="id_pais">Pais</label>
        <input type="text" name="pais" class="form-control @error('pais') is-invalid 
        @enderror" id="id_pais" placeholder="El Salvador" value="{{old('pais',$ubicacion->pais)}}"
            onKeyUp="toUpperCaseField(this);n_pais_mask(this);" required>
        @error('pais')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="id_ciudad">Ciudad</label>
        <input type="text" name="ciudad" class="form-control @error('ciudad') is-invalid 
        @enderror" id="id_ciudad" placeholder="San Salvador" value="{{old('ciudad',$ubicacion->ciudad)}}"
            onKeyUp="toUpperCaseField(this);n_pais_mask(this);" required>
        @error('ciudad')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="id_latitud">Latitud</label>
        <input type="number" step="0.0000000000001" name="latitud" class="form-control @error('latitud') is-invalid 
        @enderror" id="id_latitud" placeholder="San Salvador" value="{{old('latitud',$ubicacion->latitud)}}"
            onKeyUp="n_latitud_mask(this);" required>
        @error('latitud')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="id_longitud">Longitud</label>
        <input type="number" step="0.0000000000001" name="longitud" class="form-control @error('longitud') is-invalid 
        @enderror" id="id_longitud" placeholder="San Salvador" value="{{old('longitud',$ubicacion->longitud)}}"
            onKeyUp="n_longitud_mask(this);" required>
        @error('longitud')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-success btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>
