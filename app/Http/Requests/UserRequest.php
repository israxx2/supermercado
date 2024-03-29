<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        $id = $this->route('user');

        return [
            'rut'       => 'min:11|max:13|required|unique:users,rut,'.$id,
            'name'      => 'min:3|max:100|required',
            'apellido'  => 'min:3|max:100|required',
            'email'     => 'min:4|max:100|email|unique:users,email,'.$id,
            'password'  => 'sometimes|required|confirmed|min:6',
            'id_rol'    => 'required',
        ];
    }
}
