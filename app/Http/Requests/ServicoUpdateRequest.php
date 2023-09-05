<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServicoUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'servico_tipo_id' => ['required', 'integer', 'numeric'],
            //'valor' => ['required', 'decimal:2']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome é requerido.',
            'name.min' => 'O Nome deve ter pelo menos 3 caracteres.',
            'servico_tipo_id.required' => 'O Serviço Tipo é requerido.',
            'servico_tipo_id.integer' => 'O Serviço Tipo deve ser um ítem da lista.',
            //'valor.required' => 'O Valor é requerido.',
        ];
    }
}
