<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVueloRequest extends FormRequest
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
            'origen_id' => 'required|integer',
            'destino_id' => 'required|integer',
            'avion_id' => 'required|integer',
            'despegue' => 'required|string',
            'aterrizaje' => 'required|string',
            'precio' => 'required|numeric',
            'recorrido' => 'required|numeric',
        ];
    }
}
