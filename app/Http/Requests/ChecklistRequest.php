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
        
        // A multiplicação é por dois, pois existe dois campos para cada registro a ser validado (aprovado e observacao)
        $qtddocs = $documentos->count() * 2;



        $campos = [];
        $rules = [];

        // $campos = array();
        // $rules = array();

        foreach ($documentos as $documento) {

            $id = $documento->id;
            
            // Formando o nome dos campos dinamicamente
            $campos[] = "aprovado_$id";         
            $campos[] = "observacao_$id";

        }

        foreach ($documentos as $documento) {

            $id = $documento->id;
            
            // Formando o nome dos campos dinamicamente
            $rules["aprovado_$id"] = "required";         
    
        }
    
        return $rules;
    }

    public function messages()
    {
        /* 
        $requerenteId = $this->route('requerente');     // $requerente =  Requerente::find($requerenteId); $nomeRequerente = $requerente->nomecompleto;

        $documentos =  Documento::where('requerente_id', "=", $requerenteId)->get();
        
        $messages = [];


        foreach ($documentos as $documento) {

            $messages[] = "'aprovado_$documento->id.required' => 'escolha uma opção', 'observacao_$documento->id.required_if' => 'Campo obrigatório'";
        }



        return $messages; 
        */

        return [
            'aprovado_31' => 'Escolha uma opção',
            'aprovado_32' => 'Escolha uma opção',
        ];
    }
}


