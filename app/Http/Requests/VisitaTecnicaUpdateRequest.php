<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VisitaTecnicaUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'visita_tecnica_status_id' => ['required', 'integer', 'numeric'],
            'cliente_id' => ['required', 'integer', 'numeric'],
            'data_visita' => ['required', 'date_format:d/m/Y'],
            'responsavel_funcionario_id' => ['nullable', 'integer', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'visita_tecnica_status_id.required' => 'O Status é requerido.',
            'visita_tecnica_status_id.integer' => 'O Status deve ser um ítem da lista.',
            'cliente_id.required' => 'O Cliente é requerido.',
            'cliente_id.integer' => 'O Cliente deve ser um ítem da lista.',
            'data_visita.required' => 'A Data é requerido.',
            'data_visita.date_format' => 'A Data Visita não é uma data válida.',
            'responsavel_funcionario_id.required' => 'O Responsável deve ser um ítem da lista.'
        ];
    }
}
