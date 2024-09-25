<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegionalRequest;
use App\Models\Regional;

class RegionalController extends Controller
{

    public function create()
    {
        return view('regionais.create');
    }


    public function store(RegionalRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Gravar dados no banco
        Regional::create($request->all());

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('regional.create')->with('success', 'Regional cadastrada com sucesso!');
    }

}
