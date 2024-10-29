<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequerimentoRequest extends FormRequest
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
            // DETALHAMENTO DO REQUERIMENTO
            'requerente_id'                             => '',
            'processojudicial'                          => 'required',
            'orgaojudicial'                             => 'required',
            'comarca'                                   => 'required',
            'prazomedidaprotetiva'                      => 'required',
            'dataconcessaomedidaprotetiva'              => 'required',
            'medproturgcaminhaprogoficial'              => 'required',
            'medproturgafastamentolar'                  => 'required',
            'riscmortvioldomesmoradprotegsigilosa'      => 'required',
            'riscvidaaguardmedproturg'                  => 'required',
            'relatodescomprmedproturgagressor'          => 'required',
            'sitvulnerabnaoconsegarcardespmoradia'      => 'required',
            'temrendfamiliardoissalconvivagressor'      => 'required',
            'paiavofilhonetomaiormesmomunicipresid'     => 'required',
            'parentesmesmomunicipioresidencia'          => 'required_if:paiavofilhonetomaiormesmomunicipresid,==,"1"',
            'filhosmenoresidade'                        => 'required',
            'trabalhaougerarenda'                       => 'required',
            'valortrabalhorenda'                        => 'required_if:trabalhaougerarenda,==,"1"',
            'temcadunico'                               => 'required',
            'teminteresformprofisdesenvolvhabilid'      => 'required',
            'apresentoudocumentoidentificacao'          => 'required',
            'cumprerequisitositensnecessarios'          => 'required',
        ];
    }


    public function messages(): array
    {
        return[
            // DETALHAMENTO DO REQUERIMENTO
            'processojudicial.required'                             => 'Campo obrigatório!',
            'orgaojudicial.required'                                => 'Campo obrigatório!',
            'comarca.required'                                      => 'Campo obrigatório!',
            'prazomedidaprotetiva.required'                         => 'Informe uma data!',
            'dataconcessaomedidaprotetiva.required'                 => 'Informe uma data!',
            'medproturgcaminhaprogoficial.required'                 => 'Escolha uma opção!',
            'medproturgafastamentolar.required'                     => 'Escolha uma opção!',
            'riscmortvioldomesmoradprotegsigilosa.required'         => 'Escolha uma opção!',
            'riscvidaaguardmedproturg.required'                     => 'Escolha uma opção!',
            'relatodescomprmedproturgagressor.required'             => 'Escolha uma opção!',
            'sitvulnerabnaoconsegarcardespmoradia.required'         => 'Escolha uma opção!',
            'temrendfamiliardoissalconvivagressor.required'         => 'Escolha uma opção!',
            'paiavofilhonetomaiormesmomunicipresid.required'        => 'Escolha uma opção!',
            'parentesmesmomunicipioresidencia.required_if'          => 'Especifique o parente!',
            'filhosmenoresidade.required'                           => 'Escolha uma opção!',
            'trabalhaougerarenda.required'                          => 'Escolha uma opção!',
            'valortrabalhorenda.required_if'                        => 'Informe o valor!',
            'temcadunico.required'                                  => 'Escolha uma opção!',
            'teminteresformprofisdesenvolvhabilid.required'         => 'Escolha uma opção!',
            'apresentoudocumentoidentificacao.required'             => 'Escolha uma opção!',
            'cumprerequisitositensnecessarios.required'             => 'Escolha uma opção!',
        ];
    }
}
