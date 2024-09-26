<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegionalRequest;
use App\Models\Regional;
use Exception;
use Illuminate\Support\Str;

class RegionalController extends Controller
{

    public function index()
    {
        // Recuperar os registros do banco dados sem pesquisa
        $regionais = Regional::orderByDesc('created_at')->paginate(10);

        return view('regionais.index', ['regionais' => $regionais]);
    }


    public function create()
    {
        return view('regionais.create');
    }


    public function store(RegionalRequest $request)
    {
        // Validar o formulário
        $request->validated();

        try {

            // Gravar dados no banco
            // Regional::create($request->all());
            Regional::create([
                'nome' => Str::upper($request->nome),
                'ativo' => $request->ativo
            ]);

             // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('regional.index')->with('success', 'Regional cadastrada com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Regional não cadastrada!');
        }
    }


    // Carregar o formulário editar regional
    public function edit(Regional $regional)
    {
        // carregar a view
        return view('regionais.edit', ['regional' => $regional]);
    }

    // Atualizar no banco de dados a regional
    public function update(RegionalRequest $request, Regional $regional)
    {
        // Validar o formulário
        $request->validated();

        try{
            $regional->update([
                'nome' => Str::upper($request->nome),
                'ativo' => $request->ativo
            ]);

            return  redirect()->route('regional.index')->with('success', 'Regional editada com sucesso!');

        } catch(Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Regional não editada. Tente outra vez!');

        }

    }


    // Excluir o regional do banco de dados
    public function destroy(Regional $regional)
    {
        try {
            // Excluir o registro do banco de dados
            $regional->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('regional.index')->with('success', 'Regional excluída com sucesso!');

        } catch (Exception $e) {


            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('regional.index')->with('error', 'Regional não excluída!');
        }
    }

}
