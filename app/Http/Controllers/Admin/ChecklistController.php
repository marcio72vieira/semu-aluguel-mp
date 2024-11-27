<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requerente;

class ChecklistController extends Controller
{
    public function index()
    {
        // Recuperando requerentes e seus registros relacionados
        // $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'user'])->orderBy('nomecompleto')->paginate(10);
        $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'user'])->where('status', '=', 2)->orderBy('nomecompleto')->paginate(10);
        return view('admin.checklists.index', [ 'requerentes' => $requerentes ]);
    }
}
