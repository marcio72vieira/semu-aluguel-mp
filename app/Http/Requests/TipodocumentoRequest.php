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
            'ativo' => 'bail|required',
        ];
    }

    public function messages(): array
    {
        return[
            'nome.required' => 'Campo nome é obrigatório!',
            'nome.unique' => 'Este documento já está cadastrado!',
            'ativo.required' => 'Campo ativo é obrigatório!',
        ];
    }
}
