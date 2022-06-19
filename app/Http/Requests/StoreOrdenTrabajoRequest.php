<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdenTrabajoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vin_vehiculo' => 'nullable|alpha_num', //|unique:orden_trabajos
            'placa_vehiculo' => 'nullable|alpha_num',
            'propietario_vehiculo' => 'required|string',
            'marca_vehiculo' => 'required|alpha',
            'modelo_vehiculo' => 'required|string',//regex para alfanumerico + espacios
            'anio_vehiculo' => 'required|integer',
            'kilometraje_vehiculo' => 'required|integer',//rellenar y enviar
            'unidad_vehiculo' => 'required|string',     //campo oculto
            'cliente_id' => 'required|integer',
            'tecnico_encargado' => 'required|string',
            'descripcion_servicio' => 'required|string',
            'detalle_servicio' => 'required',   //rellenar y enviar
            'monto_servicio' => 'required|numeric',
            'cancelado_servicio' => 'required|numeric|lte:monto_servicio',
            'pagado' => 'nullable',//a;adir campo invisible
            'observacion_servicio' => 'nullable|string',
            'trabajo_realizado' => 'nullable|string',
            'fecha_entrada' => 'required|date|before_or_equal:fecha_salida',//la entrada debe estar antes que la salida
            'fecha_salida' => 'nullable|date',
            'proximo_servicio' => 'nullable|date|after:fecha_salida',
            'contactado' => 'nullable|boolean',
            'metodo' => 'required|string',
        ];
    }
}
