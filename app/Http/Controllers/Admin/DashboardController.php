<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regional;
use App\Models\Municipio;
use App\Models\Tipounidade;
use App\Models\Unidadeatendimento;
use App\Models\Tipodocumento;
use App\Models\Requerente;
use App\Models\User;
use App\Models\Processo;


class DashboardController extends Controller
{
    public function index()
    {
        // Obtendo os todais de entidades do sistema
        $totRegionais       =  Regional::all()->count();
        $totMunicipios      =  Municipio::all()->count();
        $totTipounidades    =  Tipounidade::all()->count();
        $totUnidades        =  Unidadeatendimento::all()->count();
        $totTipodocumentos  =  Tipodocumento::all()->count();
        $totRequerentes     =  Requerente::all()->count();
        $totProcessos       =  Requerente::totalprocessos();
        $totUsuarios        =  User::all()->count();

        // Recuperando todos os processos
        $processos = Processo::orderBy('nomecompleto')->paginate(10);

        return view('admin.dashboard.index', compact('totRegionais', 'totMunicipios', 'totTipounidades', 'totUnidades', 'totTipodocumentos', 'totUsuarios', 'totRequerentes', 'totProcessos', 'processos'));
    }
}
