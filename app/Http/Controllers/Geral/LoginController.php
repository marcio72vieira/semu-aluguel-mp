<?php

namespace App\Http\Controllers\Geral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Login
    public function index()
    {
        // Carregar a view
        return view('geral.login.index');
    }


    // Validar os dados do usuário no login
    public function processalogin(LoginRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Validar o usuário e a senha com as informações do banco de dados
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        // Se o usuário não foi autenticado (!), significa que os dados estão incorretos
        if(!$authenticated){

            // Redirecionar o usuário para página anterior "login(área restrita)", mantendo os dados digitados e enviar a mensagem de erro
            return back()->withInput()->with('error', 'E-mail ou senha inválidos!');
        }

        // Depois de autenticado, deve-se obter o usuário autenticado
        $user = Auth::user();
        $user = User::find($user->id);

        
        if($user->primeiroacesso == 1){
        
            // Redireciona o usuário para a página para alterar senha fornecida pelo administrador
            // Obs: Neste ponto, o usuário irá está autenticado no sistema mesmo que o mesmo seja direcionado para a página de
            // redefinir nova senha. Neste caso, deve-se, validar os dados do usuário buscando o email e nome do usuário e o id
            // e depois de o mesmo ter alterado sua senha, deve-se deslogá-lo e redirecioná-lo para a página de login novamente.
            // OU de outra forma. O usuário recebe o e-mail com a senha definida pelo Administrador, e no corpo do email, vai
            // a senha definida pelo administrador (uma número aleatório de fácil entendimento) e um link direcionando o usuário
            // diretamente para a página de redefinir a senha recebida para uma nova senha.
            return redirect()->route('login.create-user', ['user' => Auth::user()->id])->with('warning', 'Olá '. Auth::user()->nome .', é necessário que você redefina sua senha!');
        
        } else {
        
            /* // Verifica se o usuário possui o papel "Super Admin"
            if($user->hasRole('Super Admin')){
                // Recupera no banco TODAS as permissões, apenas o nome(pluck) em forma de array(toArray)
                $permissions = Permission::pluck('name')->toArray();
            }else{
                // Recupera no banco SÓ SÓ as permissõoes que o papel do usuário possui. Apenas o nome em forma de array
                // Obs: o usuário possui um papel, o papel possui permissões, portando obtém as permissões do usuári via papel
                $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();
            }
    
            // Ao usuário é atribuída só as permissões que o mesmo possui.
            // Obs: o método "syscPermissions", recebe um array. "$permissions" é um array(... toArray())
            $user->syncPermissions($permissions);
            */
    
            // Redirecionar o usuário para o Dashboard, caso o mesmo seja autenticado 
            // return redirect()->route('dashboard.index')->with('success', 'Seja bem vindo!');
            // Redireciona o usuário para a página dashboard e lá são exibidas os menus o que mesmo tem acesso
            return redirect()->route('regional.index')->with('success', 'Seja bem vindo!');
        }

    }


    // Carregar o formulário cadastrar novo usuário
    public function create()
    {
        // Carregr a view
        return view('geral.login.create');
    }

    public function store(LoginUserRequest $request)
    {
         // Validar o formulário
         $request->validated();

         // Marca o ponto inicial de uma transação
         DB::beginTransaction();

         try {

            // Cadastrar no banco de dados na tabela usuários
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Depois de o usuário se cadastrar via página de Login, atribui-se o PAPEL Aluno para o mesmo como padrão.
            $user->assignRole('Aluno');

            // Salvar log
            Log::info('Usuário cadastrado.', ['id' => $user->id, $user->name]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('login.index')->with('success', 'Usuário cadastrado com sucesso!');

        } catch (Exception $e) {

            // Salvar log
            Log::warning('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }




    // Deslogar o usuário
    public function logout()
    {
        // Deslogar o usuário
        Auth::logout();

        // Redireciona o usuário enviando a mensagem de sucesso
        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');

    }
    
}
