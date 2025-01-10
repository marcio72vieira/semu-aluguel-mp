<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequerenteRequest;
use App\Models\Detalherequerente;
use App\Models\Locacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Municipio;
use App\Models\Requerente;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;


class RequerenteController extends Controller
{

    public function index()
    {
        // Recuperando o Usuario authenticado
        $user = Auth::user();

        // Recuperando a Unidade de Atendimento do Usuário authenticado
        $unidadeatendimento_user = $user->unidadeatendimento_id;

        // Recuperando todas os municípios
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        // Se o usuário authenticado for ADM, exibe todos os registros, caso contrário só os registros da sua Unidade de Atendimento
        // Recuperando Requerentes e seus relacionamentos
        if($user->perfil == "adm"){
            $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'user'])->orderBy('nomecompleto')->paginate(10);
            return view('admin.requerentes.index', [
                'requerentes' => $requerentes,
                'municipios' => $municipios,
            ]);
        } else{
            $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'user'])->where('unidadeatendimento_id', '=', $unidadeatendimento_user)->orderBy('nomecompleto')->paginate(10);
            return view('admin.requerentes.index', [
                'requerentes' => $requerentes,
                'municipios' => $municipios,
            ]);
        }

    }


    public function create()
    {
        // Recuperando todas os municípios
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        return view('admin.requerentes.create', [ 'municipios' => $municipios]);
    }



    public function store(RequerenteRequest $request)
    {

        // Validar o formulário
        $request->validated();

        // Marcar o ponto inicial de uma transação
        DB::beginTransaction();


        try {

            // Depois de autenticado, deve-se obter o usuário autenticado
            $user = Auth::user();
            $user = User::find($user->id);


            // Obtém o id da Regional através do relacionamento existente entre município e regional
            $idRegionalRequerente = Municipio::find($request->municipio_id)->regional->id;

            // Obtém o id do tipo de unidade onde o requerente está sendo atendido pelo usuáro que está atendendo
            $idTipoUnidadeRequerente = $user->tipounidade->id;

            // Obtém o id do tipo de unidade onde o requerente está sendo atendido pelo usuáro que está atendendo
            $idUnidadeatendimentoRequerente = $user->unidadeatendimento->id;

            // Obtém o id do usuario que atendeu o requerente pelo usuário autenticado
            $idUsuarioRequerente = $user->id;

            // Tansforma o valor do TrabalhoRenda para o formato adequado aceito pelo banco de dados
            if($request->valortrabalhorenda != null){
                $valorTtrabalhoRendaTransformando = str_replace(',', '.', str_replace('.', '', $request->valortrabalhorenda));
            } else {
                $valorTtrabalhoRendaTransformando = 0.00;
            }

            // Tansforma o valor do ValorCadunico para o formato adequado aceito pelo banco de dados
            if($request->valortemcadunico != null){
                $valorTemCadunicoTransformando = str_replace(',', '.', str_replace('.', '', $request->valortemcadunico));
            } else {
                $valorTemCadunicoTransformando = 0.00;
            }

            // Salva informações do Requetente e recupera o Id do Requerente salvo no banco na variável $requerente
            $requerente = Requerente::create([

                'nomecompleto'              => Str::upper($request->nomecompleto),
                'sexobiologico'             => $request->sexobiologico,
                'nascimento'                => $request->nascimento,
                'naturalidade'              => $request->naturalidade,
                'nacionalidade'             => $request->nacionalidade,
                'rg'                        => $request->rg,
                'orgaoexpedidor'            => $request->orgaoexpedidor,
                'cpf'                       => $request->cpf,
                'banco'                     => $request->banco,
                'agencia'                   => $request->agencia,
                'conta'                     => $request->conta,
                'contaespecifica'           => $request->contaespecifica,
                'comunidade'                => $request->comunidade,
                'outracomunidade'           => $request->outracomunidade,
                'racacor'                   => $request->racacor,
                'outraracacor'              => $request->outraracacor,
                'identidadegenero'          => $request->identidadegenero,
                'outraidentidadegenero'     => $request->outraidentidadegenero,
                'orientacaosexual'          => $request->orientacaosexual,
                'outraorientacaosexual'     => $request->outraorientacaosexual,
                'deficiente'                => $request->deficiente,
                'deficiencia'               => $request->deficiencia,
                'escolaridade'              => $request->escolaridade,
                'profissao'                 => $request->profissao,
                'estadocivil'               => $request->estadocivil,
                'endereco'                  => $request->endereco,
                'numero'                    => $request->numero,
                'complemento'               => $request->complemento,
                'bairro'                    => $request->bairro,
                'cep'                       => $request->cep,
                'foneresidencial'           => $request->foneresidencial,
                'fonecelular'               => $request->fonecelular,
                'email'                     => $request->email,
                'regional_id'               => $idRegionalRequerente,
                'municipio_id'              => $request->municipio_id,
                'tipounidade_id'            => $idTipoUnidadeRequerente,
                'unidadeatendimento_id'     => $idUnidadeatendimentoRequerente,
                'user_id'                   => $idUsuarioRequerente,
                'estatus'                   => 1    // Situação do requerimento: 1 - Andamento 2 - Análise 3 - Pendente 4 - Corrigido 5 - Concluído
            ]);


            // Salva informações dos Detalhes do Requetente. O Id do requerente é fornecido na variavel $requerente
            $detalhe = Detalherequerente::create([
                'requerente_id'                             => $requerente->id,
                'processojudicial'                          => $request->processojudicial,
                'orgaojudicial'                             => Str::upper($request->orgaojudicial),
                'comarca'                                   => Str::upper($request->comarca),
                'prazomedidaprotetiva'                      => $request->prazomedidaprotetiva,
                'dataconcessaomedidaprotetiva'              => $request->dataconcessaomedidaprotetiva,
                'medproturgcaminhaprogoficial'              => $request->medproturgcaminhaprogoficial,
                'medproturgafastamentolar'                  => $request->medproturgafastamentolar,
                'riscmortvioldomesmoradprotegsigilosa'      => $request->riscmortvioldomesmoradprotegsigilosa,
                'riscvidaaguardmedproturg'                  => $request->riscvidaaguardmedproturg,
                'relatodescomprmedproturgagressor'          => $request->relatodescomprmedproturgagressor,
                'sitvulnerabnaoconsegarcardespmoradia'      => $request->sitvulnerabnaoconsegarcardespmoradia,
                'temrendfamiliardoissalconvivagressor'      => $request->temrendfamiliardoissalconvivagressor,
                'possuiparenteporeminviavelcompartilhardomicilio'     => $request->possuiparenteporeminviavelcompartilhardomicilio,
                'parentesinviavelcompartilhardomicilio'          => $request->parentesinviavelcompartilhardomicilio,
                'filhosmenoresidade'                        => $request->filhosmenoresidade,
                'trabalhaougerarenda'                       => $request->trabalhaougerarenda,
                'valortrabalhorenda'                        => $valorTtrabalhoRendaTransformando,    // $request->valortrabalhorenda,
                'temcadunico'                               => $request->temcadunico,
                'valortemcadunico'                          => $valorTemCadunicoTransformando,       // $request->valortemcadunico,
                'teminteresformprofisdesenvolvhabilid'      => $request->teminteresformprofisdesenvolvhabilid,
                'apresentoudocumentoidentificacao'          => $request->apresentoudocumentoidentificacao,
                'cumprerequisitositensnecessarios'          => $request->cumprerequisitositensnecessarios
            ]);

            // Operação concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('requerente.index')->with('success', 'Requerente cadastrada com sucesso!');
            // return redirect()->route('requerentedetalhe.create', ['requerente' => $requerente] )->with('success', 'Informações da Requerente cadastrada com sucesso!');

        } catch (Exception $e) {

             // Operação não é concluiída com êxito
             DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Requerente não cadastrada!'. $e->getMessage());
        }
    }



    public function show(Requerente $requerente)
    {

        $requerente =  Requerente::with(['detalhe'])->find($requerente->id);

        $arr_comunidade = ['1' => 'Cigano', '2' => 'Quilombola', '3' => 'Matriz Africana', '4' => 'Indígena', '5' => 'Assentado / acampado', '6' => 'Pessoa do campo / floresta', '7'  => 'Pessoa em situação de rua', '20' => 'Outra'];
        $arr_racacor = ['1' => 'Branca' ,'2' => 'Preta', '3' => 'Amarela', '4' => 'Parda', '5' => 'Indígena', '6' => 'Não se aplica', '20' => 'Outra'];
        $arr_identidadegenero = ['1' => 'Feminino', '2' => 'Transexual', '3' => 'Travesti', '4' => 'Transgênero', '20' => 'Outra'];
        $arr_orientacaosexual = ['1' => 'Homossexual', '2' => 'Heterossexual', '3' => 'Bissexual', '20' => 'Outra'];
        $arr_estadocivil = ['1' => 'Solteira', '2' => 'Casada', '3' => 'Divorciada', '4' => 'Viúva', '20' => 'Outro'];
        $arr_escolaridade = ['1' => 'Fundamental incompleto', '2' => 'Fundamental completo', '3' => 'Médio incompleto', '4' => 'Médio completo', '5' => 'Superior incompleto', '6' => 'Superior completo', '7' => 'Pós-graduação incompleto', '8' => 'Pós-graduação completo'];

        // Exibe os detalhes do requerente
        return view('admin.requerentes.show', [
            'arr_comunidade' => $arr_comunidade,
            'arr_racacor' => $arr_racacor,
            'requerente' => $requerente,
            'arr_identidadegenero' => $arr_identidadegenero,
            'arr_orientacaosexual' => $arr_orientacaosexual,
            'arr_estadocivil' => $arr_estadocivil,
            'arr_escolaridade' => $arr_escolaridade,
        ]);

    }


    public function edit(Requerente $requerente)
    {
        $requerente =  Requerente::with(['detalhe'])->find($requerente->id);

        // Recuperando todas os municípios
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        return view('admin.requerentes.edit', [
            'requerente' => $requerente,
            'municipios' => $municipios,
        ]);
    }


    // Atualizar no banco de dados a requerente
    public function update(RequerenteRequest $request, Requerente $requerente)
    {
        // Validar o formulário
        $request->validated();

        // Marcar o ponto inicial de uma transação
        DB::beginTransaction();


        try{
             // Depois de autenticado, deve-se obter o usuário autenticado
             $user = Auth::user();
             $user = User::find($user->id);


             // Obtém o id da Regional através do relacionamento existente entre município e regional
             $idRegionalRequerente = Municipio::find($request->municipio_id)->regional->id;

             // Obtém o id do tipo de unidade onde o requerente está sendo atendido pelo usuáro que está atendendo
             $idTipoUnidadeRequerente = $user->tipounidade->id;

             // Obtém o id do tipo de unidade onde o requerente está sendo atendido pelo usuáro que está atendendo
             $idUnidadeatendimentoRequerente = $user->unidadeatendimento->id;

             // Obtém o id do usuario que atendeu o requerente pelo usuário autenticado
             $idUsuarioRequerente = $user->id;

            // Tansforma o valor do TrabalhoRenda para o formato adequado aceito pelo banco de dados
            if($request->valortrabalhorenda != null){
                $valorTtrabalhoRendaTransformando = str_replace(',', '.', str_replace('.', '', $request->valortrabalhorenda));
            } else {
                $valorTtrabalhoRendaTransformando = 0.00;
            }

            // Tansforma o valor do ValorCadunico para o formato adequado aceito pelo banco de dados
            if($request->valortemcadunico != null){
                $valorTemCadunicoTransformando = str_replace(',', '.', str_replace('.', '', $request->valortemcadunico));
            } else {
                $valorTemCadunicoTransformando = 0.00;
            }

            $requerente->update([
                'nomecompleto'              => Str::upper($request->nomecompleto),
                'sexobiologico'             => $request->sexobiologico,
                'nascimento'                => $request->nascimento,
                'naturalidade'              => $request->naturalidade,
                'nacionalidade'             => $request->nacionalidade,
                'rg'                        => $request->rg,
                'orgaoexpedidor'            => $request->orgaoexpedidor,
                'cpf'                       => $request->cpf,
                'banco'                     => $request->banco,
                'agencia'                   => $request->agencia,
                'conta'                     => $request->conta,
                'contaespecifica'           => $request->contaespecifica,
                'comunidade'                => $request->comunidade,
                'outracomunidade'           => $request->outracomunidade,
                'racacor'                   => $request->racacor,
                'outraracacor'              => $request->outraracacor,
                'identidadegenero'          => $request->identidadegenero,
                'outraidentidadegenero'     => $request->outraidentidadegenero,
                'orientacaosexual'          => $request->orientacaosexual,
                'outraorientacaosexual'     => $request->outraorientacaosexual,
                'deficiente'                => $request->deficiente,
                'deficiencia'               => $request->deficiencia,
                'escolaridade'              => $request->escolaridade,
                'profissao'                 => $request->profissao,
                'estadocivil'               => $request->estadocivil,
                'endereco'                  => $request->endereco,
                'numero'                    => $request->numero,
                'complemento'               => $request->complemento,
                'bairro'                    => $request->bairro,
                'cep'                       => $request->cep,
                'foneresidencial'           => $request->foneresidencial,
                'fonecelular'               => $request->fonecelular,
                'email'                     => $request->email,
                'regional_id'               => $idRegionalRequerente,
                'municipio_id'              => $request->municipio_id,
                'tipounidade_id'            => $idTipoUnidadeRequerente,
                'unidadeatendimento_id'     => $idUnidadeatendimentoRequerente,
                'user_id'                   => $idUsuarioRequerente,
                'estatus'                    => 1   // Situação do requerimento: 1 - Andamento 2 - Análise 3 - Pendente 4 - Corrigido 5 - Concluído
            ]);

            $requerente->detalhe()->update([
                'requerente_id'                             => $requerente->id,
                'processojudicial'                          => $request->processojudicial,
                'orgaojudicial'                             => Str::upper($request->orgaojudicial),
                'comarca'                                   => Str::upper($request->comarca),
                'prazomedidaprotetiva'                      => $request->prazomedidaprotetiva,
                'dataconcessaomedidaprotetiva'              => $request->dataconcessaomedidaprotetiva,
                'medproturgcaminhaprogoficial'              => $request->medproturgcaminhaprogoficial,
                'medproturgafastamentolar'                  => $request->medproturgafastamentolar,
                'riscmortvioldomesmoradprotegsigilosa'      => $request->riscmortvioldomesmoradprotegsigilosa,
                'riscvidaaguardmedproturg'                  => $request->riscvidaaguardmedproturg,
                'relatodescomprmedproturgagressor'          => $request->relatodescomprmedproturgagressor,
                'sitvulnerabnaoconsegarcardespmoradia'      => $request->sitvulnerabnaoconsegarcardespmoradia,
                'temrendfamiliardoissalconvivagressor'      => $request->temrendfamiliardoissalconvivagressor,
                'possuiparenteporeminviavelcompartilhardomicilio'     => $request->possuiparenteporeminviavelcompartilhardomicilio,
                'parentesinviavelcompartilhardomicilio'          => $request->parentesinviavelcompartilhardomicilio,
                'filhosmenoresidade'                        => $request->filhosmenoresidade,
                'trabalhaougerarenda'                       => $request->trabalhaougerarenda,
                'valortrabalhorenda'                        => $valorTtrabalhoRendaTransformando,    // $request->valortrabalhorenda,
                'temcadunico'                               => $request->temcadunico,
                'valortemcadunico'                          => $valorTemCadunicoTransformando,       // $request->valortemcadunico,
                'teminteresformprofisdesenvolvhabilid'      => $request->teminteresformprofisdesenvolvhabilid,
                'apresentoudocumentoidentificacao'          => $request->apresentoudocumentoidentificacao,
                'cumprerequisitositensnecessarios'          => $request->cumprerequisitositensnecessarios

            ]);

             // Operação concluída com êxito
             DB::commit();


             // Redirecionar o usuário, enviar a mensagem de sucesso
            return  redirect()->route('requerente.index')->with('success', 'Requerente editado com sucesso!');

        } catch(Exception $e) {

             // Operação não é concluiída com êxito
             DB::rollBack();

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error-exception', 'Requerente não editado. Tente mais tarde!'. $e->getMessage());
        }

    }


    // Excluir o requerente do banco de dados
    public function destroy(Requerente $requerente)
    {
        try {
            // Excluir o registro do banco de dados
            $requerente->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('requerente.index')->with('success', 'Requerente excluída com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('user.index')->with('error-exception', 'Requerente não excluída. Tente mais tarde!');
        }
    }



    public function relpdfrequerente(Requerente $requerente)
    {
        // Obtendo os dados
        $requerente =  Requerente::with('detalhe')->find($requerente->id);

        $arr_comunidade = ['1' => 'Cigano', '2' => 'Quilombola', '3' => 'Matriz Africana', '4' => 'Indígena', '5' => 'Assentado / acampado', '6' => 'Pessoa do campo / floresta', '7'  => 'Pessoa em situação de rua', '20' => 'Outra'];
        $arr_racacor = ['1' => 'Branca' ,'2' => 'Preta', '3' => 'Amarela', '4' => 'Parda', '5' => 'Indígena', '6' => 'Não se aplica', '20' => 'Outra'];
        $arr_identidadegenero = ['1' => 'Feminino', '2' => 'Transexual', '3' => 'Travesti', '4' => 'Transgênero', '20' => 'Outra'];
        $arr_orientacaosexual = ['1' => 'Homossexual', '2' => 'Heterossexual', '3' => 'Bissexual', '20' => 'Outra'];
        $arr_estadocivil = ['1' => 'Solteira', '2' => 'Casada', '3' => 'Divorciada', '4' => 'Viúva', '20' => 'Outro'];
        $arr_escolaridade = ['1' => 'Fundamental incompleto', '2' => 'Fundamental completo', '3' => 'Médio incompleto', '4' => 'Médio completo', '5' => 'Superior incompleto', '6' => 'Superior completo', '7' => 'Pós-graduação incompleto', '8' => 'Pós-graduação completo'];

        // Saneando o cpf para compor o nom do arquivo
        $cpf = str_replace('.','',str_replace('-','',$requerente->cpf));

        // Definindo o nome do arquivo a ser baixado
        $fileName = ('Requerimento_'.$cpf.'.pdf');

        // Invocando a biblioteca mpdf e definindo as margens do arquivo
        $mpdf = new \Mpdf\Mpdf([
            'orientation' => 'P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 40,
            'margin_bottom' => 10,
            'margin-header' => 10,
            'margin_footer' => 5
        ]);

        // Configurando o cabeçalho da página
        $mpdf->SetHTMLHeader('
            <table style="width:717px; border-bottom: 1px solid #000000; margin-bottom: 3px;">
                <tr>
                    <td style="width: 717px; text-align:center">
                        <img src="images/logo-maranhao.png" width="80"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 717px; text-align:center; font-size: 10px; font-family: Arial, Helvetica, sans-serif; font:bold">
                        ESTADO DO MARANHÃO<br>
                        SECRETARIA DE ESTADO DA MULHER<br>
                    </td>
                </tr>
            </table>
        ');

        // Configurando o rodapé da página
        $mpdf->SetHTMLFooter('
            <table style="width:717px; border-top: 1px solid #000000; font-size: 10px; font-family: Arial, Helvetica, sans-serif;">
                <tr>
                    <td width="500px" align="left">Av. Jerônimo de Albuquerque, s/n, Palácio Henrique de La Roque – 2º andar, Jardim Renascença</td>
                    <td width="217px" align="right">São Luis(MA) {DATE d/m/Y - H:i:s}</td>
                </tr>
            </table>
        ');


        // Definindo a view que deverá ser renderizada como arquivo .pdf e passando os dados da pesquisa
        $html = \View::make('admin.requerentes.pdfs.pdf_requerimento', compact('requerente','arr_comunidade', 'arr_racacor', 'arr_identidadegenero', 'arr_orientacaosexual', 'arr_escolaridade', 'arr_estadocivil', 'mpdf'));
        $html = $html->render();

        // Definindo o arquivo .css que estilizará o arquivo blade na view ('admin.empresa.pdf.pdfempresa')
        $stylesheet = file_get_contents('pdf/mpdf.css');
        $mpdf->WriteHTML($stylesheet, 1);

        // Transformando a view blade em arquivo .pdf e enviando a saida para o browse (I); 'D' exibe e baixa para o pc
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');

    }


}
