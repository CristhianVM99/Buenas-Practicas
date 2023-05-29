<?php

namespace App\Http\Requests\IdeaProyecto;

use Illuminate\Foundation\Http\FormRequest;

class StoreIdeaProyectoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo'          => 'nullable',
            'sector'        => 'required',
            'pais'          => 'required',
            'ciudad'        => 'required',
            'titulo'        => 'required',
            'descripcion'   => 'required',
            'poblacion'     => 'required',
            'entidad'       => 'nullable',
            'presupuesto'   => 'nullable',
            'ods'           => 'nullable',
            'popularidad'   => 'nullable',
            'latitud'       => 'nullable',
            'longitud'      => 'nullable',
            'estado'        => 'nullable',
        ];
    }
}
