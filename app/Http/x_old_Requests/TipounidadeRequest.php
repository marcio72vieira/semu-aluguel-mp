<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipounidadeRequest extends FormRequest
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
        $tipounidadeId = $this->route('tipounidade');

        return [
            'nome' => 'bail|required|unique:tipounidades,nome,'. ($tipounidadeId ? $tipounidadeId->id : null),
            'ativo' => 'bail|required',
        ];
    }

    public function messages(): array
    {
        return[
            'nome.required' => 'Campo nome é obrigatório!',
            'nome.unique' => 'Este tipo já está cadastrado!',
            'ativo.required' => 'Campo ativo é obrigatório!',
        ];
    }
}
