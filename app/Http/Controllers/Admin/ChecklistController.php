<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requerente;

class ChecklistController extends Controller
{
    public function index()
    {
        // Recuperando somente os Requerente (com registros relacionados) que estão na situação de pendente(2) ou corrigidos(4), para análise do Servidor da SEMU
        //$requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'documentos', 'user'])->where('status', '=', 2)->orWhere('status', '=', 4)->orderBy('nomecompleto')->paginate(10);
        $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'documentos', 'user'])->orderBy('nomecompleto')->paginate(10);
        return view('admin.checklists.index', [ 'requerentes' => $requerentes ]);
    }
}
