@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="origen_id">Origen</label>
        <select name="origen_id" class="form-control">
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{old('ubicacion', $ubicacion->id)}}" selected>{{$ubicacion->id}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="destino_id">Destino</label>
        <select name="destino_id" class="form-control">
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{old('ubicacion', $ubicacion->id)}}" selected>{{$ubicacion->id}}</option>
                @endforeach
        </select>
    </div>
    
    <div class="form-group col-md-6">
        <label for="avion_id">Avion</label>
        <select name="avion_id" class="form-control">
                @foreach ($aviones as $avion)
                    <option value="{{old('avion', $avion->id)}}" selected>{{$avion->id}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="id_despegue">Despegue</label>
        <input type="text" name="despegue" class="form-control @error('despegue') is-invalid 
        @enderror" id="id_despegue" placeholder="30/06/2022 07:00:00" value="{{old('despegue',$vuelo->despegue)}}"
            onKeyUp="n_despegue_mask(this);" required>
        @error('despegue')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="id_aterrizaje">Aterrizaje</label>
        <input type="text" name="aterrizaje" class="form-control @error('aterrizaje') is-invalid 
        @enderror" id="id_aterrizaje" placeholder="30/06/2022 07:00:00" value="{{old('aterrizaje',$vuelo->aterrizaje)}}"
            onKeyUp="n_aterrizaje_mask(this);" required>
        @error('aterrizaje')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="id_precio">Precio</label>
        <input type="text" name="precio" class="form-control @error('precio') is-invalid 
        @enderror" id="id_precio" placeholder="1500" value="{{old('precio',$vuelo->precio)}}"
            onKeyUp="n_precio_mask(this);" required>
        @error('precio')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-12">
        <label for="id_recorrido">Recorrido</label>
        <input type="text" name="recorrido" class="form-control @error('recorrido') is-invalid 
        @enderror" id="id_recorrido" placeholder="3691.9" value="{{old('recorrido',$vuelo->recorrido)}}"
            onKeyUp="n_recorrido_mask(this);" required>
        @error('recorrido')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-danger btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>