<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CpfValidateRule;

class RequerenteRequest extends FormRequest
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

        $requerenteId = $this->route('requerente');

        return [
            'nomecompleto'          => 'required',
            'rg'                    => 'required',
            'orgaoexpedidor'        => 'required',
            'cpf'                   => ['required', 'unique:requerentes,cpf,'. ($requerenteId ? $requerenteId->id : null), new CpfValidateRule()],
            'sexobiologico'         => 'required',
            'banco'                 => 'required',
            'agencia'               => 'required',
            'conta'                 => 'required',
            'contaespecifica'       => 'required',
            'comunidade'            => 'required',
            'outracomunidade'       => 'required_if:comunidade,==,"20"',
            'racacor'               => 'required',
            'outraracacor'          => 'required_if:racacor,==,"20"',
            'identidadegenero'      => 'required',
            'outraidentidadegenero' => 'required_if:identidadegenero,==,"20"',
            'orientacaosexual'      => 'required',
            'outraorientacaosexual' => 'required_if:orientacaosexual,==,"20"',
            'deficiente'            => 'required',
            'deficiencia'           => 'required_if:deficiente,==,"1"',
            'endereco'              => 'required',
            'numero'                => 'required',
            'bairro'                => 'required',
            'cep'                   => 'required',
            'foneresidencial'       => 'required_if:fonecelular,==,null',
            'fonecelular'           => 'required_if:foneresidencial,==,null',
            'email'                 => 'required|email',
            'municipio_id'          => 'required'
            //'complemento'
            //'regional_id'
            //'tipounidade_id'
            //'unidadeatendimento_id'
            //'user-id'
            //'status'
        ];
    }


    public function messages(): array
    {
        return[
            'nomecompleto.required'             => 'Campo nome é obrigatório!',
            'rg.required'                       => 'Campo rg é obrigatório',
            'orgaoexpedidor.required'           => 'Campo órgão expedidor é obrigatório',
            'cpf.required'                      => 'Campo cpf é obrigatório!',
            'cpf.unique'                        => 'Este cpf já está cadastrado!',
            'sexobiologico.required'            => 'Escolha mas ou fem!',
            'banco.required'                    => 'Campo banco é obrigatório!',
            'agencia.required'                  => 'Campo agência é obrigatório!',
            'conta.required'                    => 'Campo conta é obrigatório!',
            'contaespecifica.required'          => 'Escolha sim ou não!',
            'comunidade.required'               => 'Campo comunidade é obrigatório!',
            'outracomunidade.required_if'       => 'Especifique a outra comunidade espcífica / tradicional!',
            'racacor.required'                  => 'Campo raça/cor é obrigatório!',
            'outraracacor.required_if'          => 'Especifique a outra raça / cor!',
            'identidadegenero.required'         => 'Campo identidade de gênero é obrigatório!',
            'outraidentidadegenero.required_if' => 'Especifique a outra identidade de gênero!',
            'orientacaosexual.required'         => 'Campo orientação sexual é obraigatório',
            'outraorientacaosexual.required_if' => 'Especifique a outra orientacao sexual!',
            'deficiente.required'               => 'Escolha sim ou não!',
            'deficiencia.required_if'           => 'Especifique a deficiência!',
            'endereco.required'                 => 'Campo endereço é obrigatório!',
            'numero.required'                   => 'Campo núemro é obrigatório (digie s/n, se não houver)!',
            'bairro.required'                   => 'Campo bairro é obrigatório!',
            'cep.required'                      => 'Campo cep é obrigatório!',
            'foneresidencial.required_if'       => 'Informe um telefone residencial ou celular!',
            'fonecelular.required_if'           => 'Informe um telefone celular ou residencial!',
            'email.required'                    => 'O campo Email é obrigatório!',
            'email.email'                       => 'O campo Email precisa ser válido!',
            'municipio_id.required'             => 'Campo município é obrigatório!',
        ];
    }
}
