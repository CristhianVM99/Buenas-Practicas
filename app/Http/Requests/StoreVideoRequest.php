<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titulo'        => ['required'],
            'descripcion'   => ['required'],
            'entidad_id'    => ['sometimes'],
            'sector_id'     => ['sometimes'],
            'pais_id'       => ['sometimes'],
            'autor_id'      => ['sometimes'],
            'ods'           => ['sometimes'],
            'foto'          => ['sometimes', 'image'],
            'url'           => ['required', 'url'],
        ];
    }
}
