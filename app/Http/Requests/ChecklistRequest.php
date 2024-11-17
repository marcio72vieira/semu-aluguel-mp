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


        $requerenteId = $this->route('requerente'); //$requerente =  Requerente::find($requerenteId); $nomeRequerente = $requerente->nomecompleto;

        $documentos =  Documento::where('requerente_id', "=", $requerenteId)->get();
            
        $rules = [];

        foreach ($documentos as $documento) {

            $validacao = "'aprovado_$documento->id' => 'required', 'observacao_$documento->id' => 'required_if:aprovado_$documento->id, ==, '0'";

            $rules[] = eval("\$validacao = \"$validacao\";");
        }

        //eval("\$rule = $rule;");
        return $rules;
    }

    public function messages()
    {
        $requerenteId = $this->route('requerente');     // $requerente =  Requerente::find($requerenteId); $nomeRequerente = $requerente->nomecompleto;

        $documentos =  Documento::where('requerente_id', "=", $requerenteId)->get();
        
        $messages = [];


        foreach ($documentos as $documento) {

            $messages[] = "'aprovado_$documento->id.required' => 'escolha uma opção', 'observacao_$documento->id.required_if' => 'Campo obrigatório'";
        }



        return $messages;
    }
}


