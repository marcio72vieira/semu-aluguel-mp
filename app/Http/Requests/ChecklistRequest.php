<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Requerente;
use App\Models\Documento;

class ChecklistRequest extends FormRequest
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
        //Uma forma de obter os dados enviados para o método: public function update(ChecklistRequest $request) diretamente aqui no FormRequest (ChecklistRequest)
        //$requerenteId = $this->requerente_id_hidden;

        //Aqui, estou recebendo o id, pelo recurso: Id-Route-Bounding do Laravel, pois o id do requetente é fornecido na rota
        $requerenteId = $this->route('requerente');
        $documentos =  Documento::where('requerente_id', "=", $requerenteId)->get();

        $rule = [];

        foreach ($documentos as $documento) {

            $id = $documento->id;

            // Formando o nome dos campos dinamicamente
            $rule["aprovado_$id"] = 'required';
            $rule["observacao_$id"] = 'required_if:aprovado_'.$id.',==,"0"';

        }

        return $rule;
    }

    public function messages()
    {
        $requerenteId = $this->route('requerente');
        $documentos =  Documento::where('requerente_id', "=", $requerenteId)->get();

        $message = [];

        foreach ($documentos as $documento) {

            $id = $documento->id;

            // Formando as mensagens para cada tipo de campo, UTILIZANDO O COMPONENT <x-alert/> NO INÍCO DA VIEW
            // $message["aprovado_$id.required"] = 'Escolha uma opção para o documento: '.$id;
            // $message["observacao_$id.required_if"] = 'É necessário uma justificativa para o documento: '.$id;

            // Formando as mensagens para cada tipo de campo
            $message["aprovado_$id.required"] = 'Escolha uma opção';
            $message["observacao_$id.required_if"] = 'Este campo é obrigatório!';

        }

        return $message;
    }
}


