<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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


}
