@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="id_nombre">Nombre de el pasajero</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid 
        @enderror" id="id_nombre" placeholder="Julio Eduardo" value="{{old('nombre',$pasajero->nombre)}}"
            onKeyUp="toUpperCaseField(this);n_nombre_mask(this);" required>
        @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="id_apellido">Apellido de el pasajero</label>
        <input type="text" name="apellido" class="form-control @error('apellido') is-invalid 
        @enderror" id="id_apellido" placeholder="Castañeda Lopez" value="{{old('apellido',$pasajero->apellido)}}"
            onKeyUp="toUpperCaseField(this);n_nombre_mask(this);" required>
        @error('apellido')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
 
    <div class="form-group col-md-6">
        <label for="genero">Genero</label>
        <select name="genero" class="form-control">
            <option value="M" @if(old("genero", $pasajero->genero)=="M") selected @endif>MASCULINO</option>
            <option value="F" @if(old("genero", $pasajero->genero)=="F") selected @endif>FEMENINO</option>
            <option value="O" @if(old("genero", $pasajero->genero)=="O") selected @endif>OTRO</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="ubicacion_id">Ubicacion</label>
        <select name="ubicacion_id" class="form-control">
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{old('ubicacion', $ubicacion->id)}}" selected>{{$ubicacion->ciudad.", ".$ubicacion->pais}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group col-md-12">
        <label for="id_nacimiento">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid 
        @enderror" id="id_nacimiento" placeholder="1985-05-23" value="{{old('fecha_nacimiento',$pasajero->fecha_namiento)}}"
            onKeyUp="toUpperCaseField(this);n_nombre_mask(this);" required>
        @error('fecha_nacimiento')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button pt-4 col-md-12"> <button type="submit" class="btn btn-success btn-block btn-lg"><span>{{$btnText}}</span></button> </div>

</div>