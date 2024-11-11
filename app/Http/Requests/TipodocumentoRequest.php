<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipodocumentoRequest extends FormRequest
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
        $tipodocumentoId = $this->route('tipodocumento');

        return [
            'nome' => 'bail|required|unique:tipodocumentos,nome,'. ($tipodocumentoId ? $tipodocumentoId->id : null),
            'ordem' => 'required|numeric|min:1|max:20',
            'ativo' => 'bail|required',
        ];
    }

    public function messages(): array
    {
        return[
            'nome.required' => 'Campo nome é obrigatório!',
            'nome.unique' => 'Este documento já está cadastrado!',
            'ordem.required' => "Campo Obrigatório",
            'ordem.numeric' => "A ordem tem que ser um número entre 1 e 20",
            'ordem.min' => "O númro de órdem mínimo é 1",
            'ordem.max' => "O númro de órdem mínimo é 20",
            'ativo.required' => 'Campo ativo é obrigatório!',
        ];
    }
}
