@csrf
<div class="form-row">

    <div class="form-group col-md-12">
        <label for="id_nombre">Nombre de la Aerolinea</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid 
        @enderror" id="id_nombre" placeholder="Avianca" value="{{old('nombre',$aerolinea->nombre)}}"
            onKeyUp="toUpperCaseField(this);n_nombre_mask(this);" required>
        @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-success btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>