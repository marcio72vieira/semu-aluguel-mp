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



            $requerente = Requerente::create([

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
            // return redirect()->route('requerente.index')->with('success', 'Requerente cadastrada com sucesso!');
            return redirect()->route('requerentedetalhe.create', ['requerente' => $requerente] )->with('success', 'Informações da Requerente cadastrada com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Requerente não cadastrada!');
        }
    }



    public function show(Requerente $requerente)
    {

        $arr_comunidade = ['1' => 'Cigano', '2' => 'Quilombola', '3' => 'Matriz Africana', '4' => 'Indígena', '5' => 'Assentado / acampado', '6' => 'Pessoa do campo / floresta', '7'  => 'Pessoa em situação de rua', '20' => 'Outra'];
        $arr_racacor = ['1' => 'Preta', '2' => 'Amarela', '3' => 'Parda', '4' => 'Indígena', '5' => 'Não se aplica', '20' => 'Outra'];
        $arr_identidadegenero = ['1' => 'Feminino', '2' => 'Transexual', '3' => 'Travesti', '4' => 'Transgênero', '20' => 'Outra'];
        $arr_orientacaosexual = ['1' => 'Homossexual', '2' => 'Heterossexual', '3' => 'Bissexual', '20' => 'Outra'];


        // Exibe os detalhes do requerente
        return view('admin.requerentes.show', [
            'arr_comunidade' => $arr_comunidade,
            'arr_racacor' => $arr_racacor,
            'requerente' => $requerente,
            'arr_identidadegenero' => $arr_identidadegenero,
            'arr_orientacaosexual' => $arr_orientacaosexual

        ]);

    }


    public function edit(Requerente $requerente)
    {

        // Recuperando todas os municípios e unidades de atendimentos
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


            $requerente->update([
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

            return  redirect()->route('requerente.index')->with('success', 'Requerente editado com sucesso!');

        } catch(Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error-exception', 'Requerente não editado. Tente mais tarde!'.$e);

        }

    }


    public function createdetalhe(Requerente $requerente)
    {
        return view('admin.requerentes.createdetalhe', ['requerente' => $requerente]);
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


}
