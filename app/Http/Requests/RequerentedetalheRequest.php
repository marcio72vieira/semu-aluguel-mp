<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequerentedetalheRequest extends FormRequest
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
            'requerente_id' => '',
            'processojudicial' => 'required',
            'orgaojudicial' => 'required',
            'comarca' => 'required',
            'prazomedidaprotetiva' => 'required',
            'dataconcessaomedidaprotetiva' => 'required',
            'medproturgcaminhaprogoficial' => 'required',
            'medproturgafastamentolar' => 'required',
            'riscmortvioldomesmoradprotegsigilosa' => 'required',
            'riscvidaaguardmedproturg' => 'required',
            'relatodescomprmedproturgagressor' => 'required',
            'sitvulnerabnaoconsegarcardespmoradia' => 'required',
            'temrendfamiliardoissalconvivagressor' => 'required',
            'paiavofilhonetomaiormesmomunicipresid' => 'require',
            'parentesmesmomunicipioresidencia' => 'required_if: paiavofilhonetomaiormesmomunicipresid, ==, 1',
            'filhosmenoresidade' => 'required',
            'trabalhaougerarenda' => 'required',
            'valortrabalhorenda' => 'required_if:trabalhaougerarenda, ==, 1',
            'temcadunico' => 'required',
            'teminteresformprofisdesenvolvhabilid' => 'required',
            'apresentoudocumentoidentificacao' => 'required',
            'cumprerequisitositensnecessarios' => 'required',
        ];
    }
}
