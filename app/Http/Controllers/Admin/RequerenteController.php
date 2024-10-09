<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequerenteRequest;
use Illuminate\Http\Request;
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
        // Recuperando todas os municípios
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        // Recuperando requerentes e seus registros relacionados
        $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'user'])->orderBy('nomecompleto')->paginate(10);
        return view('admin.requerentes.index', [
            'requerentes' => $requerentes,
            'municipios' => $municipios,
        ]);
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



            Requerente::create([

                'nomecompleto'              => Str::upper($request->nomecompleto),
                'rg'                        => $request->rg,
                'orgaoexpedidor'            => $request->orgaoexpedidor,
                'cpf'                       => $request->cpf,
                'sexobiologico'             => $request->sexobiologico,
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
                'status'                    => 1
            ]);

             // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('requerente.index')->with('success', 'Requerente cadastrada com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Requerente não cadastrada!');
        }
    }




}
