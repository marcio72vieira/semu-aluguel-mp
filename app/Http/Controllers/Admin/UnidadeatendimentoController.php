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
        $unidadesatendimentos = Unidadeatendimento::orderByDesc('created_at')->paginate(10);
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


}
