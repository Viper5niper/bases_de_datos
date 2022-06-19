@csrf
<div class="form-row">

    <div class="form-group col-md-8">
        <label for="id_nombre">Nombre del Cliente</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid 
        @enderror" id="id_nombre" placeholder="Pedro Antonio Rodriguez" value="{{old('nombre',$cliente->nombre)}}"
            onKeyUp="toUpperCaseField(this);n_nombre_mask(this);" required>
        @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="id_telefono">Telefono del Cliente</label>
        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid 
        @enderror" id="id_telefono" placeholder="77777777" value="{{old('telefono',$cliente->telefono)}}"
            onKeyUp="n_telefono_mask(this);" required>
        @error('telefono')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-danger btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>