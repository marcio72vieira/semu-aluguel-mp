<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeatendimentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $unidadeatendimentoId = $this->route('unidadeatendimento');

        return [
            'tipounidade_id'    => 'bail|required',
            'nome'              => 'bail|required|min:5|unique:unidadesatendimentos,nome,'. ($unidadeatendimentoId ? $unidadeatendimentoId->id : null),
            'endereco'          => 'bail|required',
            'numero'            => 'bail|required',
            'bairro'            => 'bail|required',
            'cep'               => 'bail|required',
            'fone'              => 'bail|required',
            'municipio_id'      => 'bail|required',
            'ativo'             => 'bail|required',
            //'complemento',
            //'regional_id'     
        ];
    }
}
