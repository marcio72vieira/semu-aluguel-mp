<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Municipio;
use App\Models\User;
use App\Models\Unidadeatendimento;
use Exception;
use Illuminate\Support\Str;

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

            // Cadastrar no banco de dados na tabela usuários
            User::create([
                'nomecompleto' => $request->nomecompleto,
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'regional_id' => $idRegionalMunicipio,
                'municipio_id' => $request->municipio_id,
                'unidadeatendimento_id' => $request->unidadeatendimento_id,
                'cargo' => $request->cargo,
                'fone' => $request->fone,
                'perfil' => $request->perfil,
                'email' => $request->email,
                'password' => $request->password,
                'primeiroacesso' => 1
            ]);

    
            /********************/
            // ENVIAR E-EMAIL   //
            /********************/


            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário cadastrado com sucesso!');

        } catch (Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error-exception', 'Usuário não cadastrado. Tente mais tarde!');
        }
    }



}
