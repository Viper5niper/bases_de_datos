<div class="modal" id="DeletedModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$modal_title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{$modal_message}}</p>
            </div>
            <div class="modal-footer">
            <form method="POST" action="{{$ruta}}" id="form-delete">
                @method('DELETE')
                @csrf
                <button class="btn btn-md btn-secundary" data-dismiss="modal">
                    Cancelar
                </button>
                <button class="btn btn-md btn-{{$btnTipo}}">
                    Aceptar
                </button>
            <form>
            </div>
        </div>
    </div>
</div>