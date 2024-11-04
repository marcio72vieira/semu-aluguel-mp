<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnexoRequest extends FormRequest
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
        return [
            'nome' => ['required'],
            'url' => ['required','mimes:pdf','max:2048']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'É escolha um nome descritivo para o anexo',
            'url.required' => 'É necessário escolher um arquivo',
            'url.mimes' => 'O arquivo deve ser do tipo .pdf',
            'url.max' => 'Este arquivo é muito grande, tente reduzir seu tamanho',
        ];
    }
}
