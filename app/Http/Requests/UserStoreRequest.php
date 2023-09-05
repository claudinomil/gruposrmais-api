<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['nullable', 'unique:users', 'email']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome é requerido.',
            'email.unique' => 'O E-mail já existe.',
            'email.email' => 'O E-mail deve ser um endereço válido.'
        ];
    }
}
