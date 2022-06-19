<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCotizacionRequest extends FormRequest
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
            'propietario_vehiculo' => 'nullable|string',
            'marca_vehiculo' => 'nullable|alpha',
            'modelo_vehiculo' => 'nullable|string',//regex para alfanumerico + espacios
            'anio_vehiculo' => 'nullable|integer',
            'kilometraje_vehiculo' => 'nullable|integer',//rellenar y enviar
            'unidad_vehiculo' => 'nullable|string',     //campo oculto
            'cliente_id' => 'required|integer',
            'tecnico_encargado' => 'nullable|string',
            'descripcion_servicio' => 'nullable|string',
            'detalle_servicio' => 'required',   //rellenar y enviar
            'monto_servicio' => 'nullable|numeric',
            'cancelado_servicio' => 'nullable|numeric|lte:monto_servicio',
            'pagado' => 'nullable',//a;adir campo invisible
            'observacion_servicio' => 'nullable|string',
            'trabajo_realizado' => 'nullable|string',
            'fecha_entrada' => 'nullable|date|before_or_equal:fecha_salida',//la entrada debe estar antes que la salida
            'fecha_salida' => 'nullable|date',
            'proximo_servicio' => 'nullable|date|after:fecha_salida',
            'contactado' => 'nullable|boolean',
            'cotizacion' => 'nullable|boolean',
            'metodo' => 'nullable|string',
        ];
    }
}
