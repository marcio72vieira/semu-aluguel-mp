<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requerente;
use App\Models\Municipio;

class RequerimentoController extends Controller
{
    public function index(Requerente $requerente)
    {
        // Recuperando todas os requerimentos da requerente
        $municipios = Municipio::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        return view('admin.requerimentos.index', compact('requerente'));
    }
}
