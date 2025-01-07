<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Mail\Acesso;
use App\Models\Municipio;
use App\Models\Tipounidade;
use App\Models\User;
use App\Models\Unidadeatendimento;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        // Recuperando todas os municípios e unidades de atendimentos
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        $unidadesatendimentos = Unidadeatendimento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        // Recuperando usuários e seus registros relacionados
        $users = User::with(['regional', 'municipio', 'unidadeatendimento'])->orderBy('nome')->paginate(10);
        return view('admin.users.index', [
            'users' => $users,
            'municipios' => $municipios,
            'unidadesatendimentos' => $unidadesatendimentos,
        ]);
    }

    public function create()
    {
        // Recuperando todas os municípios e unidades de atendimentos
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        $unidadesatendimentos = Unidadeatendimento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        return view('admin.users.create', [
            'municipios' => $municipios,
            'unidadesatendimentos' => $unidadesatendimentos,
        ]);
    }

    public function getunidadesatendimentomunicipio(Request $request)
    {
        $condicoes = [
            ['municipio_id', '=', $request->municipio_id],
            ['ativo', '=', 1]
        ];

        $data['unidadesatendimento'] = Unidadeatendimento::where($condicoes)->orderBy('nome', 'ASC')->get();
        return response()->json($data);
    }



    public function store(UserRequest $request)
    {

        // Validar o formulário
        $request->validated();



        try {
            // Obtém o id da Regional através do relacionamento existente entre município e regional
            $idRegionalMunicipio = Municipio::find($request->municipio_id)->regional->id;

            // Obtém o id do tipo de Unidade através do relacionamento existente entre a unidade e o tipounidade
            $idTipounidadeUnidadeatendimento = Unidadeatendimento::find($request->unidadeatendimento_id)->tipounidade->id;

            // Cadastrar no banco de dados na tabela usuários
            User::create([
                'nomecompleto' => $request->nomecompleto,
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'regional_id' => $idRegionalMunicipio,
                'municipio_id' => $request->municipio_id,
                'tipounidade_id' => $idTipounidadeUnidadeatendimento,
                'unidadeatendimento_id' => $request->unidadeatendimento_id,
                'cargo' => $request->cargo,
                'fone' => $request->fone,
                'perfil' => $request->perfil,
                'email' => $request->email,
                'password' => $request->password,
                'ativo' => $request->ativo,
                'primeiroacesso' => 1
            ]);


            /********************/
            // ENVIAR E-EMAIL   //
            /********************/
            $envioEmail = Mail::to($request->email, $request->nomecompleto)->send(new Acesso([
                'fromName' => 'SEMU',
                'fromEmail' => 'semu@email.ma.gov.br',
                'subject' => 'Credencias de Acesso ao Sistema de Aluguel Maria da Penha',
                'message' => "Olá $request->nomecompleto, suas credencias para acesso ao sistema Aluguel Maria da Penha é: email $request->email, senha: $request->password"
            ]));

            if($envioEmail){
                // Redirecionar o usuário, enviar a mensagem de sucesso
                return redirect()->route('user.index')->with('success', 'Usuário cadastrado com sucesso!');
            } else {
                // Redirecionar o usuário, enviar a mensagem de sucesso
                return redirect()->route('user.index')->with('success', 'Usuário cadastrado com sucesso!');
            }

            // Redirecionar o usuário, enviar a mensagem de sucesso
            // return redirect()->route('user.index')->with('success', 'Usuário cadastrado com sucesso!');

        } catch (Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error-exception', 'Usuário não cadastrado. Tente mais tarde!');
        }
    }



    public function show(User $user)
    {
        // Exibe os detalhes do usuário
        return view('admin.users.show', ['user' => $user]);

    }


    public function edit(User $user)
    {
        // Recuperando todas os municípios e unidades de atendimentos
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        $unidadesatendimentos = Unidadeatendimento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        return view('admin.users.edit', [
            'user' => $user,
            'municipios' => $municipios,
            'unidadesatendimentos' => $unidadesatendimentos,
        ]);
    }


    // Atualizar no banco de dados a unidade de atendimento
    public function update(UserRequest $request, User $user)
    {
        // Validar o formulário
        $request->validated();

        try{
            // Obtém o id da Regional através do relacionamento existente entre município e regional
            $idRegionalMunicipio = Municipio::find($request->municipio_id)->regional->id;

            // Obtém o id do tipo de Unidade através do relacionamento existente entre a unidade e o tipounidade
            $idTipounidadeUnidadeatendimento = Unidadeatendimento::find($request->unidadeatendimento_id)->tipounidade->id;


            if($request->password == ''){
                $passwordUser = $request->old_password_hidden;
                $defAcesso = 0;
            }else{
                $passwordUser = bcrypt($request->password);
                $defAcesso = 1;
            }


            $user->update([
                'nomecompleto' => $request->nomecompleto,
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'regional_id' => $idRegionalMunicipio,
                'municipio_id' => $request->municipio_id,
                'tipounidade_id' => $idTipounidadeUnidadeatendimento,
                'unidadeatendimento_id' => $request->unidadeatendimento_id,
                'cargo' => $request->cargo,
                'fone' => $request->fone,
                'perfil' => $request->perfil,
                'email' => $request->email,
                'password' => $passwordUser,
                'ativo' => $request->ativo,
                'primeiroacesso' => $defAcesso
            ]);

            return  redirect()->route('user.index')->with('success', 'Usuário editado com sucesso!');

        } catch(Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error-exception', 'Usuário não editado. Tente mais tarde!'.$e);

        }

    }


    // Excluir o usuário do banco de dados
    public function destroy(User $user)
    {
        try {
            // Excluir o registro do banco de dados
            $user->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('user.index')->with('error-exception', 'Usuário não excluído. Tente mais tarde!');
        }
    }


    public function relpdflistusers()
    {
        // Obtendo os dados
        $users = User::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento'])->orderBy('nomecompleto')->get();

        // Definindo o nome do arquivo a ser baixado
        $fileName = ('Usuarios_lista.pdf');

        // Invocando a biblioteca mpdf e definindo as margens do arquivo
        $mpdf = new \Mpdf\Mpdf([
            'orientation' => 'L',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 30,
            'margin_bottom' => 15,
            'margin-header' => 10,
            'margin_footer' => 5
        ]);

        // Configurando o cabeçalho da página
        $mpdf->SetHTMLHeader('
            <table style="width:1080px; border-bottom: 1px solid #000000; margin-bottom: 3px;">
                <tr>
                    <td style="width: 108px">
                        <img src="images/logo-ma.png" width="80"/>
                    </td>
                    <td style="width: 432px; font-size: 10px; font-family: Arial, Helvetica, sans-serif;">
                        Governo do Estado do Maranhão<br>
                        Secretaria de Estado da Mulher / SEMU<br>
                        Agência de Tecnologia da Informação / ATI<br>
                        Aluguel Lei Maria da Penha
                    </td>
                    <td style="width: 540px;" class="titulo-rel">
                        USUÁRIOS
                    </td>
                </tr>
            </table>
            <table style="width:1080px; border-collapse: collapse">
                <tr>
                    <td width="40px" class="col-header-table">ID</td>
                    <td width="160px" class="col-header-table">NOME</td>
                    <td width="100px" class="col-header-table">PERFIL / CARGO</td>
                    <td width="200px" class="col-header-table">REGIONAL / MUNICÍPIO</td>
                    <td width="200px" class="col-header-table">E-mal / Telefone</td>
                    <td width="100px" class="col-header-table">CPF</td>
                    <td width="230px" class="col-header-table">TIPO / UNIDADE ATENDIMENTO</td>
                    <td width="50px" class="col-header-table">ATIVO</td>
                </tr>
            </table>
        ');

        // Configurando o rodapé da página
        $mpdf->SetHTMLFooter('
            <table style="width:1080px; border-top: 1px solid #000000; font-size: 10px; font-family: Arial, Helvetica, sans-serif;">
                <tr>
                    <td width="200px">São Luis(MA) {DATE d/m/Y}</td>
                    <td width="830px" align="center"></td>
                    <td width="50px" align="right">{PAGENO}/{nbpg}</td>
                </tr>
            </table>
        ');

        // Definindo a view que deverá ser renderizada como arquivo .pdf e passando os dados da pesquisa
        $html = \View::make('admin.users.pdfs.pdf_list_users', compact('users'));
        $html = $html->render();

        // Definindo o arquivo .css que estilizará o arquivo blade na view ('admin.users.pdfs.pdf_users')
        $stylesheet = file_get_contents('pdf/mpdf.css');
        $mpdf->WriteHTML($stylesheet, 1);

        // Transformando a view blade em arquivo .pdf e enviando a saida para o browse (I); 'D' exibe e baixa para o pc
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }


}
