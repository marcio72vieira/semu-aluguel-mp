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
            // INFORMAÇÕES DA REQUERENTE
            'nomecompleto'          => 'required',
            'sexobiologico'         => 'required',
            'nascimento'            => 'required',
            'naturalidade'          => 'required',
            'nacionalidade'         => 'required',
            'rg'                    => 'required',
            'orgaoexpedidor'        => 'required',
            'cpf'                   => ['required', 'unique:requerentes,cpf,'. ($requerenteId ? $requerenteId->id : null), new CpfValidateRule()],
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
            'escolaridade'          => 'required',
            'profissao'             => '',
            'estadocivil'           => 'required',
            'endereco'              => 'required',
            'numero'                => 'required',
            'bairro'                => 'required',
            'cep'                   => 'required',
            'foneresidencial'       => 'required_if:fonecelular,==,null',
            'fonecelular'           => 'required_if:foneresidencial,==,null',
            'email'                 => 'required|email',
            'municipio_id'          => 'required',
            //'complemento'           => '',
            //'regional_id'           => '',
            //'tipounidade_id'        => '',
            //'unidadeatendimento_id' => '',
            //'user_id'               => '',
            //'estatus'               => '',

            // DETALHAMENTO DO REQUERIMENTO
            'requerente_id'                             => '',
            'processojudicial'                          => 'required',
            'orgaojudicial'                             => 'required',
            'comarca'                                   => 'required',
            'prazomedidaprotetiva'                      => ['required', 'numeric'],
            'dataconcessaomedidaprotetiva'              => 'required',
            'medproturgcaminhaprogoficial'              => 'required',
            'medproturgafastamentolar'                  => 'required',
            'riscmortvioldomesmoradprotegsigilosa'      => 'required',
            'riscvidaaguardmedproturg'                  => 'required',
            'relatodescomprmedproturgagressor'          => 'required',
            'sitvulnerabnaoconsegarcardespmoradia'      => 'required',
            'temrendfamiliardoissalconvivagressor'      => 'required',
            'possuiparenteporeminviavelcompartilhardomicilio'     => 'required',
            'parentesinviavelcompartilhardomicilio'          => 'required_if:possuiparenteporeminviavelcompartilhardomicilio,==,"1"',
            'filhosmenoresidade'                        => 'required',
            'quantidadefilhosmenores'                   => 'required_if:filhosmenoresidade,==,"1"',
            'trabalhaougerarenda'                       => 'required',
            'valortrabalhorenda'                        => 'required_if:trabalhaougerarenda,==,"1"',
            'temcadunico'                               => 'required',
            'valortemcadunico'                          => 'required_if:temcadunico,==,"1"',
            'teminteresformprofisdesenvolvhabilid'      => 'required',
            'apresentoudocumentoidentificacao'          => 'required',
            'cumprerequisitositensnecessarios'          => 'required',
        ];
    }


    public function messages(): array
    {
        return[
            // INFORMAÇÕES DA REQUERENTE
            'nomecompleto.required'             => 'Campo nome é obrigatório!',
            'sexobiologico.required'            => 'Escolha masculino ou feminino!',
            'nascimento.required'               => 'Campo data de nascimento é obrigatório!',
            'naturalidade.required'             => 'Campo naturalidade é obrigatório',
            'nacionalidade.required'            => 'Campo nacionalidade é obrigatório',
            'rg.required'                       => 'Campo rg é obrigatório',
            'orgaoexpedidor.required'           => 'Campo órgão expedidor é obrigatório',
            'cpf.required'                      => 'Campo cpf é obrigatório!',
            'cpf.unique'                        => 'Este cpf já está cadastrado!',
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
            'escolaridade'                      => 'Campo escolaridade é obrigatório',
            'estadocivil.required'              => 'Campo estadocivil é obrigatório',
            'endereco.required'                 => 'Campo endereço é obrigatório!',
            'numero.required'                   => 'Campo número é obrigatório (digie s/n, se não houver)!',
            'bairro.required'                   => 'Campo bairro é obrigatório!',
            'cep.required'                      => 'Campo cep é obrigatório!',
            'foneresidencial.required_if'       => 'Informe um telefone residencial ou celular!',
            'fonecelular.required_if'           => 'Informe um telefone celular ou residencial!',
            'email.required'                    => 'O campo Email é obrigatório!',
            'email.email'                       => 'O campo Email precisa ser válido!',
            'municipio_id.required'             => 'Campo município é obrigatório!',

            // DETALHAMENTO DO REQUERIMENTO
            //'requerente_id'                                         => '',
            'processojudicial.required'                             => 'Campo obrigatório!',
            'orgaojudicial.required'                                => 'Campo obrigatório!',
            'comarca.required'                                      => 'Campo obrigatório!',
            'prazomedidaprotetiva.required'                         => 'Informe o prazo!',
            'prazomedidaprotetiva.numeric'                          => 'Informe o número de dias!',
            'dataconcessaomedidaprotetiva.required'                 => 'Informe uma data!',
            'medproturgcaminhaprogoficial.required'                 => 'Escolha uma opção!',
            'medproturgafastamentolar.required'                     => 'Escolha uma opção!',
            'riscmortvioldomesmoradprotegsigilosa.required'         => 'Escolha uma opção!',
            'riscvidaaguardmedproturg.required'                     => 'Escolha uma opção!',
            'relatodescomprmedproturgagressor.required'             => 'Escolha uma opção!',
            'sitvulnerabnaoconsegarcardespmoradia.required'         => 'Escolha uma opção!',
            'temrendfamiliardoissalconvivagressor.required'         => 'Escolha uma opção!',
            'possuiparenteporeminviavelcompartilhardomicilio.required'        => 'Escolha uma opção!',
            'parentesinviavelcompartilhardomicilio.required_if'     => 'Especifique o parente!',
            'filhosmenoresidade.required'                           => 'Escolha uma opção!',
            'quantidadefilhosmenores.required'                      => 'Escolha uma opção!',
            'quantidadefilhosmenores.required_if'                   => 'Informe o número',
            'quantidadefilhosmenores.numeric'                       => 'Apenas número!',
            'trabalhaougerarenda.required'                          => 'Escolha uma opção!',
            'valortrabalhorenda.required_if'                        => 'Informe o valor!',
            'temcadunico.required'                                  => 'Escolha uma opção!',
            'valortemcadunico.required_if'                          => 'Informe o valor!',
            'teminteresformprofisdesenvolvhabilid.required'         => 'Escolha uma opção!',
            'apresentoudocumentoidentificacao.required'             => 'Escolha uma opção!',
            'cumprerequisitositensnecessarios.required'             => 'Escolha uma opção!',
        ];
    }
}
