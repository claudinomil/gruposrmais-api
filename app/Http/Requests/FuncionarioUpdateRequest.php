<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FuncionarioUpdateRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'data_nascimento' => ['required', 'date_format:d/m/Y'],
            'genero_id' => ['required', 'integer', 'numeric'],
            'estado_civil_id' => ['nullable', 'integer', 'numeric'],
            'escolaridade_id' => ['nullable', 'integer', 'numeric'],
            'nacionalidade_id' => ['nullable', 'integer', 'numeric'],
            'naturalidade_id' => ['nullable', 'integer', 'numeric'],
            'father' => ['nullable', 'min:3'],
            'mother' => ['nullable', 'min:3'],
            'email' => [
                'nullable',
                Rule::unique('funcionarios')->ignore($this->id),
                'email'
            ],
            'telephone_1' => ['nullable', 'numeric', 'digits:10'],
            'telephone_2' => ['nullable', 'numeric', 'digits:10'],
            'cellular_1' => ['nullable', 'numeric', 'digits:11'],
            'cellular_2' => ['nullable', 'numeric', 'digits:11'],
            'funcao_id' => ['nullable', 'integer', 'numeric'],
            'data_admissao' => ['required', 'date_format:d/m/Y'],
            'data_demissao' => ['nullable', 'date_format:d/m/Y'],
            'personal_identidade_orgao_id' => ['nullable', 'integer', 'numeric'],
            'personal_identidade_estado_id' => ['nullable', 'integer', 'numeric'],
            'personal_identidade_numero' => ['nullable', 'numeric'],
            'personal_identidade_data_emissao' => ['nullable', 'date_format:d/m/Y'],
            'professional_identidade_orgao_id' => ['nullable', 'integer', 'numeric'],
            'professional_identidade_estado_id' => ['nullable', 'integer', 'numeric'],
            'professional_identidade_numero' => ['nullable', 'numeric'],
            'professional_identidade_data_emissao' => ['nullable', 'date_format:d/m/Y'],
            'cpf' => [
                'required',
                Rule::unique('funcionarios')->ignore($this->id),
                'cpf'
            ],
            'pis' => [
                'nullable',
                Rule::unique('funcionarios')->ignore($this->id),
                'nis'
            ],
            'pasep' => [
                'nullable',
                Rule::unique('funcionarios')->ignore($this->id),
                'nis'
            ],
            'carteira_trabalho' => [
                'nullable',
                Rule::unique('funcionarios')->ignore($this->id),
                'numeric'
            ],
            'cep' => ['nullable', 'digits:8'],
            'numero' => ['nullable', 'numeric'],
            'complemento' => ['nullable', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome é requerido.',
            'name.min' => 'O Nome deve ter pelo menos 3 caracteres.',
            'data_nascimento.required' => 'O Nascimento é requerido.',
            'data_nascimento.date_format' => 'O Nascimento não é uma data válida.',
            'genero_id.required' => 'O Gênero é requerido.',
            'genero_id.integer' => 'O Gênero deve ser um ítem da lista.',
            'estado_civil_id.integer' => 'O Estado Civil deve ser um ítem da lista.',
            'escolaridade_id.integer' => 'A Escolaridade deve ser um ítem da lista.',
            'nacionalidade_id.integer' => 'A Nacionalidade deve ser um ítem da lista.',
            'naturalidade_id.integer' => 'A Naturalidade deve ser um ítem da lista.',
            'father.min' => 'O Pai deve ter pelo menos 3 caracteres.',
            'mother.min' => 'A Mãe deve ter pelo menos 3 caracteres.',
            'email.unique' => 'O E-mail já existe.',
            'email.email' => 'O E-mail deve ser um endereço válido.',
            'telephone_1.numeric' => 'O Telefone 1 deve ser um número válido.',
            'telephone_1.digits' => 'O Telefone 1 deve ser um número válido.',
            'telephone_2.numeric' => 'O Telefone 2 deve ser um número válido.',
            'telephone_2.digits' => 'O Telefone 2 deve ser um número válido.',
            'cellular_1.numeric' => 'O Celular 1 deve ser um número válido.',
            'cellular_1.digits' => 'O Celular 1 deve ser um número válido.',
            'cellular_2.numeric' => 'O Celular 2 deve ser um número válido.',
            'cellular_2.digits' => 'O Celular 2 deve ser um número válido.',
            'funcao_id.integer' => 'A Função deve ser um ítem da lista.',
            'data_admissao.required' => 'O Data Admissão é requerido.',
            'data_admissao.date_format' => 'O Data Admissão não é uma data válida.',
            'data_demissao.date_format' => 'O Data Demissão não é uma data válida.',
            'personal_identidade_orgao_id.integer' => 'A Identidade Pessoal (Òrgão) deve ser um ítem da lista.',
            'personal_identidade_estado_id.integer' => 'A Identidade Pessoal (Estado) deve ser um ítem da lista.',
            'personal_identidade_numero.numeric' => 'A Identidade Pessoal (Número) deve ser um número válido.',
            'personal_identidade_data_emissao.date_format' => 'A Identidade Pessoal (Emissão) não é uma data válida.',
            'professional_identidade_orgao_id.integer' => 'A Identidade Profissional (Òrgão) deve ser um ítem da lista.',
            'professional_identidade_estado_id.integer' => 'A Identidade Profissional (Estado) deve ser um ítem da lista.',
            'professional_identidade_numero.numeric' => 'A Identidade Profissional (Número) deve ser um número válido.',
            'professional_identidade_data_emissao.date_format' => 'A Identidade Profissional (Emissão) não é uma data válida.',
            'cpf.required' => 'O CPF é requerido.',
            'cpf.unique' => 'O CPF já existe.',
            'cpf.cpf' => 'O CPF não é um número válido.',
            'pis.unique' => 'O PIS já existe.',
            'pis.nis' => 'O PIS não é um número válido.',
            'pasep.unique' => 'O PASEP já existe.',
            'pasep.nis' => 'O PASEP não é um número válido.',
            'carteira_trabalho.unique' => 'O Carteira de Trabalho já existe.',
            'carteira_trabalho.numeric' => 'A Carteira de Trabalho não é um número válido.',
            'cep.digits' => 'O CEP deve ter 8 dígitos.',
            'numero.numeric' => 'O Número deve ser um número.',
            'complemento.min' => 'O Complemento deve ter pelo menos 1 caractere.'
        ];
    }
}
