<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnidadeatendimentoRequest;
use Illuminate\Http\Request;
use App\Models\Tipounidade;
use App\Models\Municipio;
use App\Models\Unidadeatendimento;
use Egulias\EmailValidator\Parser\IDRightPart;
use Exception;
use Illuminate\Support\Str;


class UnidadeatendimentoController extends Controller
{
    public function index()
    {
        $unidadesatendimentos = Unidadeatendimento::with(['regional', 'municipio', 'tipounidade'])->orderBy('nome')->paginate(10);
        return view('admin.unidadesatendimentos.index', ['unidadesatendimentos' => $unidadesatendimentos]);
    }

    public function create()
    {
        $tiposunidades = Tipounidade::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        return view('admin.unidadesatendimentos.create', [
            'tiposunidades' => $tiposunidades,
            'municipios' => $municipios,
        ]);
    }

    public function store(UnidadeatendimentoRequest $request)
    {
        // Validar o formulário
        $request->validated();

        try {

            // Obtém o id da Regional através do relacionamento existente entre município e regional
            $idRegionalMunicipio = Municipio::find($request->municipio_id)->regional->id;
            
            Unidadeatendimento::create([
                'tipounidade_id' => $request->tipounidade_id,
                'nome' => Str::upper($request->nome),
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'cep' => $request->cep,
                'fone' => $request->fone,
                'regional_id' => $idRegionalMunicipio,
                'municipio_id' => $request->municipio_id,
                'ativo' => $request->ativo,
            ]);

             // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('unidadeatendimento.index')->with('success', 'Unidade de Atendimento cadastrada com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Unidade de Atendimento não cadastrada!');
        }
    }


    // Carregar o formulário editar unidade de atendimento
    public function edit(Unidadeatendimento $unidadeatendimento)
    {
        // carregar a view
        $tiposunidades = Tipounidade::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        return view('admin.unidadesatendimentos.edit', ['unidadeatendimento' => $unidadeatendimento, 'tiposunidades' => $tiposunidades,'municipios' => $municipios]);
    }

    // Atualizar no banco de dados a unidade de atendimento
    public function update(UnidadeatendimentoRequest $request, Unidadeatendimento $unidadeatendimento)
    {
        // Validar o formulário
        $request->validated();

        // Obtém o id da Regional através do relacionamento existente entre município e regional
        $idRegionalMunicipio = Municipio::find($request->municipio_id)->regional->id;

        try{
            $unidadeatendimento->update([
                'tipounidade_id' => $request->tipounidade_id,
                'nome' => Str::upper($request->nome),
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'cep' => $request->cep,
                'fone' => $request->fone,
                'regional_id' => $idRegionalMunicipio,
                'municipio_id' => $request->municipio_id,
                'ativo' => $request->ativo,
            ]);

            return  redirect()->route('unidadeatendimento.index')->with('success', 'Unidade de Atendimento editada com sucesso!');

        } catch(Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error-exception', 'Unidade de Atendimento não editada. Tente mais tarde!');

        }

    }

    public function show(Unidadeatendimento $unidadeatendimento)
    {
        // Exibe os detalhes da unidade de atendimento
        return view('admin.unidadesatendimentos.show', ['unidadeatendimento' => $unidadeatendimento]);

    }


    // Excluir a unidade de atendimento do banco de dados
    public function destroy(Unidadeatendimento $unidadeatendimento)
    {
        try {
            // Excluir o registro do banco de dados
            $unidadeatendimento->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('unidadeatendimento.index')->with('success', 'Unidade de Atendimento excluída com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('unidadeatendimento.index')->with('error-exception', 'Unidade de Atendimento não excluida. Tente mais tarde!');
        }
    }

}
