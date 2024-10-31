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
            'nacionalidade'         => 'required',
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
            //'status'                => '',

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

            // INFORMAÇÕES DA LOCAÇÃO
            'requerente_id'         => '',
            'detalherequerente_id'  => '',
            'nomeloc'               => 'required',
            'sexoloc'               => 'required',
            'rgloc'                 => 'required',
            'orgaoexpedidorloc'     => 'required',
            'cpfloc'                => ['required', new CpfValidateRule()],
            'nacionalidadeloc'      => 'required',
            'profissaoloc'          => '',
            'estadocivilloc'        => 'required',
            'enderecoloc'           => 'required',
            'numeroloc'             => '',
            'complementoloc'        => '',
            'bairroloc'             => 'required',
            'ceploc'                => '',
            'cidadeufloc'           => 'required',
            'enderecoimov'          => 'required',
            'numeroimov'            => '',
            'complementoimov'       => '',
            'bairroimov'            => 'required',
            'cepimov'               => '',
            'cidadeufimov'          => 'required',
            'meseslocacao'          => ['required', 'min:1', 'max:12'],
            'mesesextenso'          => 'required',
            'iniciolocacao'         => 'required',
            'fimlocacao'            => 'required',
            'valorlocacao'          => 'required',
            'valorextenso'          => 'required',
            'cidadeforo'            => 'required',
        ];
    }


    public function messages(): array
    {
        return[
            // INFORMAÇÕES DA REQUERENTE
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
            'nacionalidade.required'            => 'Campo nacionalidade é obrigatório',
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

            // INFORMAÇÕES DA LOCAÇÃO
            //'requerente_id',
            //'detalherequerente_id',
            'nomeloc.required'              => 'Campo nome do locador(a) é obrigatório',
            'sexoloc.required'              => 'Campo sexo é obrigatório',
            'rgloc.required'                => 'Campo rg é obrigatório',
            'orgaoexpedidorloc.required'    => 'Campo órgão expedidor é obrigatório',
            'cpfloc.required'               => 'Campo cpf é obrigatório',
            'nacionalidadeloc.required'     => 'Campo nacionalidade é obrigatório',
            'profissaoloc.required'         => 'Campo profissão é obrigatório',
            'estadocivilloc.required'       => 'Campo estado civil é obrigatório',
            'enderecoloc.required'          => 'Campo endereço é obrigatório',
            'bairroloc.required'            => 'Campo bairro é obrigatório',
            'cidadeufloc.required'          => 'Campo cidade / uf é obrigatório',
            'enderecoimov.required'         => 'Campo endereço é obrigatório',
            'bairroimov.required'           => 'Campo bairro é obrigatório',
            'cidadeufimov.required'         => 'Campo cidade / uf é obrigatório',
            'meseslocacao.required'         => 'Campo mêses é obrigatório',
            'meseslocacao.min'              => 'Valor mínio é 1',
            'meseslocacao.max'              => 'Valor máximo é 12',
            'mesesextenso.required'         => 'Campo meses por extenso é obrigatório',
            'iniciolocacao.required'        => 'Campo data início é obrigatório',
            'fimlocacao.required'           => 'Campo data final é obrigatório',
            'valorlocacao.required'         => 'Campo valor do aluguel é obrigatório',
            'valorextenso.required'         => 'Campo valor do aluguel por extenso é obrigatório',
            'cidadeforo.required'           => 'Campo cidade foro uf é obrigatório',
        ];
    }
}
