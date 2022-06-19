<!-- a;adir aca los campos necesarios para agregar un producto -->
<!-- abajo agregar un campo de monto total que se calcule solo pero que tambien pueda ser editado -->

<div class="container row"
    data-intro='Esta seccion le ayudara a detallar los elementos que utilizo para realizar el servicio.'>

    <h3 class="col-md-12 text-center my-4">Cotizacion del Servicio</h3>

    @error('detalle_servicio')
    <x-adminlte-alert class="col-md-12" theme="danger" title="Error" dismissable>
        Por favor detalle los materiales usados para el servicio
    </x-adminlte-alert>
    @enderror

    <div class="container row"
        data-intro='Estos campos le ayudaran a ingresar cada uno de los elementos. Explicamos para que sirve cada uno a continuacion.'>

        <div class="form-group col-md-1" data-intro='Aca ingrese la cantidad utilizada'>
            <label for="cotiz_cant">Cant.</label>
            <input type="number" min="1" value="1" class="form-control" id="cotiz_cant" onChange="calcSubt(this);"
                onkeyup="calcSubt(this);">
        </div>

        <div class="form-group col-md-3" data-intro='Brinde una pequeña descripcion del elemento usado'>
            <label for="cotiz_desc">Descripcion</label>
            <input type="text" class="form-control" id="cotiz_desc">
        </div>


        <div class="form-group col-md-2"
            data-intro='Esto sirve para distinguir si el elemento viene de parte del taller, de parte de otro taller o vendedor de repuestos (otro), o es mano de obra. Al hacer clic, podra ver las 3 opciones mencionadas.'>
            <label for="cotiz_orig">Origen</label>
            <select id="cotiz_orig" class="custom-select" aria-label="Default select example">
                <option value="Taller" selected>Taller</option>
                <option value="CarWash">CarWash</option>
                <option value="Mano de Obra">Mano de Obra</option>
                <option value="Otro">Otro</option>
            </select>
        </div>
        <div class="form-group col-md-2"
            data-intro='Este es el precio unitario. Nos ayudara a calcular el costo total del servicio. NO es obligatorio, puede dejarlo vacio e ingresar manualmente el monto total del servicio mas adelante.'>
            <label for="cotiz_pu">Precio Un.</label>
            <input type="number" min="0" step="0.01" onChange="calcSubt(this);" onkeyup="calcSubt(this);" class="form-control"
                id="cotiz_pu">
        </div>
        <div class="form-group col-md-2"
            data-intro='Se calculara automaticamente despues de ingresar la cantidad y el precio unitario'>
            <label for="cotiz_subt">Subtotal</label>
            <input type="number" min="0" step="0.01" class="form-control" id="cotiz_subt" value="0">
        </div>

        <div class="form-button col-md-2 pt-4"
            data-intro='Al hacer clic agregaremos un nuevo elemento a la tabla de cotizacion.'>
            <button type="button" class="btn btn-outline-danger btn-block btn-md"
                onclick="pushItem()"><span>Agregar</span></button>
        </div>

    </div> <!-- fin container row -->

    <table class="table table-striped table-hover col-md-12" id="carrito"
        data-intro='Aca se mostraran los elementos utilizados en el servicio. Puede agregar mas usando los campos de arriba, o quitar presionando el simbolo "-" (menos) que aparecera en cada elemento de la tabla'>
        <thead>
            <th>Cant.</th>
            <th>Descripcion</th>
            <th>Origen</th>
            <th>Precio Un</th>
            <th>Subtotal</th>
            <th>Opcion</th>
        </thead>
        <tbody id="cotizbody">
            <td colspan="6" class="text-center"><strong><i class="fas fa-info-circle"></i> Ingrese un producto usando
                    los campos de arriba. Para agregarlo presione "agregar"</strong></td>
            <!-- futuro cuerpo de la tabla -->
        </tbody>
    </table>

    <input type="hidden" id="id_detalle" name="detalle_servicio"
        value="{{old('detalle_servicio',$ordentrabajo->detalle_servicio)}}">

    <div class="form-group col-md-3"
        data-intro='Se calculara solo cada vez que agregue un elemento a la tabla. PERO tambien puede ingresarlo manualmente en caso de que no halla ingresado los precios de cada elemento'>
        <label for="id_monto">Total a pagar</label>
        <input type="number" step="0.01" min="0" name="monto_servicio" class="form-control @error('monto_servicio') es invalido
    @enderror border-info" id="id_monto" placeholder="$"
            value="{{old('monto_servicio',$ordentrabajo->monto_servicio)}}" required onChange="calcRestante(this);mostrarAlerta();"
            onKeyUp="calcRestante(this);" value="0">
        @error('monto_servicio')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-3"
        data-intro='Esta es la cantidad pagada por el cliente al momento de crear la orden de trabajo.'>
        <label for="id_cancelado">Monto cancelado</label>
        <input type="number" step="0.01" min="0" name="cancelado_servicio" class="form-control @error('cancelado_servicio') es invalido
    @enderror" id="id_cancelado" placeholder="$"
            value="{{old('cancelado_servicio') ?? $ordentrabajo->cancelado_servicio ?? 0}}" 
            onChange="calcRestante(this);" onKeyUp="calcRestante(this);" @if(!$nuevaOrden) disabled @endif>
        @error('cancelado_servicio')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    @if($nuevaOrden)
    <div class="form-group col-md-3" data-intro='Aca puede elegir entre los diferentes medios de pago disponibles.'>
        <label for="id_metodo">Medio de pago</label>
        <select id="id_metodo" name="metodo" class="custom-select" aria-label="Default select example" required>
            <option value="Efectivo" selected>Efectivo</option>
            <option value="Transferencia bancaria">Transferencia bancaria</option>
            <option value="Tarjeta de debito / credito">Tarjeta de debito / credito</option>
        </select>
    </div>
    @endif

    <div class="form-group col-md-3"
        data-intro='Este campo se calcula solo al haber ingresado el monto total y la cantidad pagada por el cliente.'>
        <label for="id_restante">Restante</label>
        <input type="number" min="0" step="0.01" class="form-control" id="id_restante" placeholder="$" disabled>
    </div>

    @error('pagado')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <input type="hidden" id="pagado" name="pagado" value="{{old('pagado',$ordentrabajo->pagado)}}" type="number">
    
    @if(!$nuevaOrden)
    
    <x-adminlte-alert class="col-md-12" theme="info" title="ATENCION" dismissable id="alerta_borrarpagos" style="display: none;">
        Si despues de editar la orden de trabajo,  <strong>total a pagar</strong> es menor que <strong>monto cancelado</strong> por el cliente, se eliminaran <strong>todos los pagos</strong> y el total cancelado sera <strong>cero (0)</strong>.
    </x-adminlte-alert>
    
    @php
    $heads = [
    'Monto',
    'Metodo',
    'Fecha',
    'Acciones',
    ];
    $config = [
    'language' => [
    "url" => "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json",
    "paginate" => [
    "next" => '»',
    "previous" => '«'
    ],
    "paging" => false,
    ],
    'order' => [[1, 'asc']],
    ];
    @endphp

    <x-adminlte-datatable id="tablapagos" :heads="$heads" :config="$config" head-theme="light" striped hoverable
        beautify with-buttons>
        @foreach($pagos as $pago)
        <tr>
            <td>{{$pago->monto}}</td>
            <td>{{($pago->metodo)}}</td>
            <td>{{($pago->created_at)}}</td>
            <td>
                <nobr>
                    <a href="{{route('pagos.edit',$pago->id)}}" class="btn btn-outline-primary"><i class="fas fa-pen"
                            data-toggle="tooltip" data-placement="top" title="Editar informacion"></i></a>
                    <span onclick="eliminar('{{route('pagos.destroy',$pago->id)}}');" data-toggle="modal"
                        data-target="#DeletedModal">
                        <a class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top"
                            title="Eliminar pago"><i class="fas fa-trash"></i></a>
                    </span>
                </nobr>
            </td>
        </tr>
        @endforeach
    </x-adminlte-datatable>

    @if(!$ordentrabajo->pagado)
    <div class="form-button col-md-12 my-2"
        data-intro='Desde aca podemos registrar un nuevo pago por parte del cliente'>
        <a href="{{route('pagos.create',['idot' => $ordentrabajo->id])}}" class="btn btn-success btn-block btn-lg"
            data-toggle="tooltip" data-placement="top" title="Registrar un pago">Registrar nuevo pago  <i class="fas fa-dollar-sign"></i></a>
    </div>
    
    @endif
    @endif
    


</div> <!-- fin container row -->

<script type="application/javascript">
    let jsonData = [];

document.addEventListener("DOMContentLoaded", function(event) {
    let jsonStr = $('#id_detalle').val();
    
    if(jsonStr != ""){
        jsonData = JSON.parse(jsonStr);
        buildTable();
        //calcTotal();
        calcRestante();
    }
    
});

function genRow(item,id){

    let row = "<tr>";
    item.forEach((element) => {
        row += "<td>"+element+"</td>";
    });
    row += '<td><a class="btn btn-outline-danger" onclick="popItem('+id+')"><i class="fas fa-minus-square"></i></a></td></tr>';

    return row;
}

function buildTable(){

    tableBody = "";

    jsonData.forEach((element,id) => {
        tableBody += genRow(element,id);
    });

    $('#cotizbody').html(tableBody);

}


function calcSubt(e){
    let cant = $('#cotiz_cant').val();
    let pu = $('#cotiz_pu').val();
    $('#cotiz_subt').val(pu * cant);
}

function calcTotal(){
    let sum = 0;
    jsonData.forEach(element => {
        sum += parseFloat(element[4]); //el 5to item del arreglo es el subtotal
    });

    $('#id_monto').val(sum);

    let jsonString = JSON.stringify(jsonData);
    $('#id_detalle').val(jsonString);//convertir en el back
    mostrarAlerta();
}

@if($nuevaOrden)
function calcRestante(){
    let monto = parseFloat($('#id_monto').val());
    let pagado = parseFloat($('#id_cancelado').val());
    let restante = monto - pagado;
    $('#id_restante').val(restante);

    if(pagado < monto){ $('#pagado').val(0); }
    else if( pagado == monto ){ $('#pagado').val(1);}
    else if( pagado > monto ){
        $('#id_cancelado').val(""); 
        $('#id_monto').val("");
        calcTotal();
        calcRestante();
        }
}
function mostrarAlerta(){}
@else
function calcRestante(){}
function mostrarAlerta(){
    let monto = parseFloat($('#id_monto').val());
    let pagado = parseFloat($('#id_cancelado').val());
    let al = document.getElementById('alerta_borrarpagos');

    if( pagado > monto ){
        al.style.display = "block";
    }
}
@endif

function popItem(id){
    jsonData.splice(id,1);
    buildTable();
    calcTotal();
}

function pushItem(){
    let cant = $('#cotiz_cant').val();
    let desc = $('#cotiz_desc').val();
    let orig = $('#cotiz_orig').val();
    let pu = $('#cotiz_pu').val();
    let subt = $('#cotiz_subt').val();

    jsonData.push([cant, desc, orig, pu, subt]);
    buildTable();
    calcTotal();
    
    $('#cotiz_cant').val("1");
    $('#cotiz_desc').val("");
    //$('#cotiz_orig').val("");
    $('#cotiz_pu').val("");
    $('#cotiz_subt').val("");

}

</script>