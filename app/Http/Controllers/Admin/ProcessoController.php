<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Processo;

class ProcessoController extends Controller
{
    public function index()
    {
        // Recuperando todos os processos
        $processos = Processo::orderBy('nomecompleto')->paginate(10);
        return view('admin.processos.index', [ 'processos' => $processos ]);
    }
}
