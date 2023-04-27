<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VisitaTecnicaUpdateRequest extends FormRequest
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
            'data_visita' => ['required', 'date_format:d/m/Y'],
            'cliente_id' => ['required', 'integer', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'data_visita.required' => 'A Data Visita é requerida.',
            'data_visita.date_format' => 'A Data Visita não é uma data válida.',
            'cliente_id.required' => 'O Cliente é requerido.',
            'cliente_id.integer' => 'O Cliente deve ser um ítem da lista.'
        ];
    }
}
