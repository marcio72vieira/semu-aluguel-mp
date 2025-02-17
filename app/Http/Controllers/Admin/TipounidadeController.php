<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TipounidadeRequest;
use App\Models\Tipounidade;
use Exception;
use Illuminate\Support\Str;

class TipounidadeController extends Controller
{
    public function index()
    {
        // Recuperar os registros do banco dados sem pesquisa
        // $tipounidades = Tipounidade::orderByDesc('created_at')->paginate(10);

        $tipounidades = Tipounidade::orderByDesc('created_at')->paginate(10);
        return view('admin.tipounidades.index', ['tipounidades' => $tipounidades]);

    }

    public function create()
    {
        return view('admin.tipounidades.create');
    }


    public function store(TipounidadeRequest $request)
    {
        // Validar o formulário
        $request->validated();

        try {

            Tipounidade::create([
                'nome' => Str::upper($request->nome),
                'descricao' => Str::upper($request->descricao),
                'ativo' => $request->ativo,
            ]);

             // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('tipounidade.index')->with('success', 'Tipo de Unidade cadastrada com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Tipo de Unidade não cadastrada!');
        }
    }


    // Carregar o formulário editar tipo de unidade
    public function edit(Tipounidade $tipounidade)
    {
        // carregar a view
        return view('admin.tipounidades.edit', ['tipounidade' => $tipounidade]);
    }

    // Atualizar no banco de dados o tipo da unidade
    public function update(TipounidadeRequest $request, Tipounidade $tipounidade)
    {
        // Validar o formulário
        $request->validated();

        try{
            $tipounidade->update([
                'nome' => Str::upper($request->nome),
                'descricao' => Str::upper($request->descricao),
                'ativo' => $request->ativo,
            ]);

            return  redirect()->route('tipounidade.index')->with('success', 'Tipo de Unidade editada com sucesso!');

        } catch(Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Tipo de Unidade não editada. Tente outra vez!');

        }

    }


    // Excluir o tipounidade do banco de dados
    public function destroy(Tipounidade $tipounidade)
    {
        try {
            // Excluir o registro do banco de dados
            $tipounidade->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('tipounidade.index')->with('success', 'Tipo de Unidade excluída com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('tipounidade.index')->with('error', 'Tipo de Unidade não excluído!');
        }
    }

}
