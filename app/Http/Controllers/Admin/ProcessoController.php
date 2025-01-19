<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Processo;
use Illuminate\Support\Facades\DB;

class ProcessoController extends Controller
{
    public function index(Request $request)
    {
        // Recuperando todos os processos sem filtro
        // $processos = Processo::orderBy('nomecompleto')->paginate(10);
        // return view('admin.processos.index', [ 'processos' => $processos ]);

        // Query com filtro
        $processos = DB::table('processos')
            ->select('id', 'url', 'nomecompleto', 'regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'assistente', 'funcionario', 'datacadastro')

            ->when($request->has('requerente'), function($query) use($request) {
                $query->where('nomecompleto', 'like', '%'. $request->requerente . '%');
            })
            ->when($request->has('regional'), function($query) use($request) {
                $query->where('regional', 'like', '%'. $request->regional . '%');
            })
            ->when($request->has('municipio'), function($query) use($request) {
                $query->where('municipio', 'like', '%'. $request->municipio . '%');
            })
            ->when($request->has('tipounidade'), function($query) use($request) {
                $query->where('tipounidade', 'like', '%'. $request->tipounidade . '%');
            })
            ->when($request->has('unidade'), function($query) use($request) {
                $query->where('unidadeatendimento', 'like', '%'. $request->unidade . '%');
            })
            ->when($request->has('analista'), function($query) use($request) {
                $query->where('funcionario', 'like', '%'. $request->analista . '%');
            })
            ->when($request->filled('data_cadastro_inicio'), function($query) use($request) {
                $query->where('datacadastro', '>=', \Carbon\Carbon::parse($request->data_cadastro_inicio)->format('Y-m-d'));
            })
            ->when($request->filled('data_cadastro_fim'), function($query) use($request) {
                $query->where('datacadastro', '<=', \Carbon\Carbon::parse($request->data_cadastro_fim)->format('Y-m-d'));
            })

        ->orderBy('nomecompleto')
        ->paginate(10);


        // Se a pesquisa foi submetida e seu valor for started, exibe o formulário de pesquisa, caso contrário esconde o formulário.
        if($request->pesquisar == "started"){
            $flag = '';
        }else{
            $flag = 'none';
        }

        return view('admin.processos.index', [
            'flag' => $flag,
            'processos' => $processos,
            'requerente' => $request->requerente,
            'regional' => $request->regional,
            'municipio' => $request->municipio,
            'tipounidade' => $request->tipounidade,
            'unidade' => $request->unidade,
            'operador' => $request->operador,
            'analista' => $request->analista,
            'data_cadastro_inicio' => $request->data_cadastro_inicio,
            'data_cadastro_fim' => $request->data_cadastro_fim
        ]); 
        
    }
}
