@if (session('status'))
    <x-adminlte-alert theme="{{ session('status') ? session('status') : 'info'}}" title="{{ session('title') ? session('title') : 'Peticion Procesada'}}" dismissable>
        {{ session('message') }}
    </x-adminlte-alert>
@endif