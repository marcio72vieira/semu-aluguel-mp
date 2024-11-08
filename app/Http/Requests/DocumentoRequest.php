<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoRequest extends FormRequest
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
            'tipodocumento_id' => ['required'],
            'url' => ['required','mimes:pdf','max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'tipodocumento_id.required' => 'Selecione um tipo de documento',
            'url.required' => 'É necessário escolher um arquivo',
            'url.mimes' => 'O arquivo deve ser do tipo .pdf',
            'url.max' => 'Este arquivo é muito grande, tente reduzir seu tamanho',
        ];
    }
}
