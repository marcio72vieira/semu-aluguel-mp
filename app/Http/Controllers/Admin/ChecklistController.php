<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requerente;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
{
    public function index(Request $request)
    {

        // Recuperando somente os Requerente (com registros relacionados) que estão na situação de pendente(2) ou corrigidos(4), para análise do Servidor da SEMU
        //$requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'documentos', 'user'])->where('status', '=', 2)->orWhere('status', '=', 4)->orderBy('nomecompleto')->paginate(10);

        /*
        // Query original sem filtro
        $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'documentos', 'user'])->orderBy('nomecompleto')->paginate(10);
        return view('admin.checklists.index', [ 'requerentes' => $requerentes ]);
        */


        // Query com filtro
        $requerentes = DB::table('requerentes')
        ->join('regionais', 'regionais.id', '=', 'requerentes.regional_id')
        ->join('municipios', 'municipios.id', '=', 'requerentes.municipio_id')
        ->join('tipounidades', 'tipounidades.id', '=', 'requerentes.tipounidade_id')
        ->join('unidadesatendimentos', 'unidadesatendimentos.id', '=', 'requerentes.unidadeatendimento_id')
        ->join('users', 'users.id', '=', 'requerentes.user_id')
        //->join('documentos', 'documentos.requerente_id', '=', 'requerentes.id')


        ->select('requerentes.id', 'requerentes.nomecompleto AS nomecompletorequerente', 'requerentes.foneresidencial', 'requerentes.fonecelular', 'requerentes.estatus',
            'regionais.nome AS nomeregional','municipios.nome AS nomemunicipio',
            'tipounidades.nome AS nometipounidade', 'unidadesatendimentos.nome AS nomeunidade',
            'users.nome AS nomeoperador')


        ->when($request->has('requerente'), function($query) use($request) {
                $query->where('requerentes.nomecompleto', 'like', '%'. $request->requerente . '%');
        })
        ->when($request->has('municipio'), function($query) use($request) {
            $query->where('municipios.nome', 'like', '%'. $request->municipio . '%');
        })
        ->when($request->has('tipounidade'), function($query) use($request) {
            $query->where('tipounidades.nome', 'like', '%'. $request->tipounidade . '%');
        })
        ->when($request->has('unidade'), function($query) use($request) {
            $query->where('unidadesatendimentos.nome', 'like', '%'. $request->unidade . '%');
        })

        //->groupBy('documentos.requerente_id')


        ->orderByDesc('nomecompletorequerente')
        ->paginate(10);

        return view('admin.checklists.index', [
            'exibirfiltro' => 'nao',
            'requerentes' => $requerentes,
            'requerente' => $request->requerente,

        ]);


    }
}
