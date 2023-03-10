<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserUpdateRequest extends FormRequest
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
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255'],
            'nacionalidad'  => ['nullable'],
            'telefono'      => ['nullable', 'integer'],
            'rol'           => ['required', 'integer'],
            'password'      => ['nullable'],
            'seudonimo'     => ['sometimes'],
            'tipo'          => ['sometimes'],
            'perfil_html'   => ['sometimes'],
            'avatar'        => ['sometimes'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        if( isset( $data['password'] ) )
        {
            $data['password'] = Hash::make($data['password']);
        }
        else
        {
            unset($data['password']);
        }
        if( $data['rol'] == $this->getRol('autor'))
        {
            $data['autor'] = [
                'name' => $data['seudonimo']?? $data['name'],
                'tipo' => $data['tipo']??'',
                'perfil_html' => $data['perfil_html']??'',
            ];
        }
        unset($data['seudonimo']);
        unset($data['tipo']);
        unset($data['perfil_html']);
        return $data;
    }

    private function getRol( $name )
    {
        if(Role::findByName($name))
        {
            return Role::findByName($name)->id;
        }
        return 2;
    }
}
