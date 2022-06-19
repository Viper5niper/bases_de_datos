<div class="container row">

    <h3 class="col-md-12 text-center my-4" id="cotizacion">Cotizacion del Servicio</h3>

    <table class="table table-striped table-hover col-md-12">
        <thead>
            <th>Cant.</th>
            <th>Descripcion</th>
            <th>Origen</th>
            <th>Precio Un</th>
            <th>Subtotal</th>
        </thead>
        <tbody id="cotizbody">
            <td colspan="6" class="text-center"><strong><i class="fas fa-info-circle"></i> Ingrese un producto usando
                    los campos de arriba. Para agregarlo presione "agregar"</strong></td>
            <!-- futuro cuerpo de la tabla -->
        </tbody>
    </table>

    <input type="hidden" id="id_detalle" name="detalle_servicio"
        value="{{old('detalle_servicio',$ordentrabajo->detalle_servicio)}}">

    <div class="form-group col-md-4">
        <label for="id_monto">Total a pagar</label>
        <input type="number" min="0" name="monto_servicio" class="form-control border-info" id="id_monto"
            value="{{old('monto_servicio',$ordentrabajo->monto_servicio)}}" disabled>
    </div>

    <div class="form-group col-md-4">
        <label for="id_cancelado">Monto cancelado</label>
        <input type="number" min="0" name="cancelado_servicio" class="form-control" id="id_cancelado"
            value="{{old('cancelado_servicio',$ordentrabajo->cancelado_servicio)}}" disabled>
    </div>

    <div class="form-group col-md-4">
        <label for="id_restante">Restante</label>
        <input type="number" name="cancelado_servicio" class="form-control" id="id_restante" value="{{
        (int) old('cancelado_servicio',$ordentrabajo->cancelado_servicio) - (int) old('cancelado_servicio',$ordentrabajo->cancelado_servicio)
        }}" disabled>
    </div>

    <input type="hidden" id="pagado" name="pagado" value="0" type="number">

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
        data-intro='En caso de que un cliente se acerque al taller a realizar un nuevo pago, podemos registrarlo haciendo clic a este boton'>
        <a href="{{route('pagos.create',['idot' => $ordentrabajo->id])}}" class="btn btn-success btn-block btn-lg"
            data-toggle="tooltip" data-placement="top" title="Registrar un pago">Registrar nuevo pago  <i class="fas fa-dollar-sign"></i></a>
    </div>
    @endif


</div> <!-- fin container row -->

<script type="application/javascript">
    let jsonData = [];

document.addEventListener("DOMContentLoaded", function(event) {
    let jsonStr = $('#id_detalle').val();
    
    if(jsonStr != ""){
        jsonData = JSON.parse(jsonStr);
        buildTable();
        calcRestante(event);
    }
});

function genRow(item,id){

    let row = "<tr>";
    item.forEach((element) => {
        row += "<td>"+element+"</td>";
    });
    row += '</tr>';

    return row;
}

function buildTable(){

    tableBody = "";

    jsonData.forEach((element,id) => {
        tableBody += genRow(element,id);
    });

    $('#cotizbody').html(tableBody);

}

function calcRestante(){
    let monto = parseFloat($('#id_monto').val());
    let pagado = parseFloat($('#id_cancelado').val());
    let restante = monto - pagado;
    $('#id_restante').val(restante);

    if(pagado < monto){ $('#pagado').val(0); }
    else if( pagado == monto ){ $('#pagado').val(1); }
    else if( pagado > monto ){ $('#id_restante').val(0); calcRestante(e);}
}

</script>