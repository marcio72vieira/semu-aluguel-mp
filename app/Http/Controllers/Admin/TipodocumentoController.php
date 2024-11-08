<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TipodocumentoRequest;
use App\Models\Tipodocumento;
use Exception;
use Illuminate\Support\Str;

class TipodocumentoController extends Controller
{
    public function index()
    {
        $tipodocumentos = Tipodocumento::orderByDesc('created_at')->paginate(10);
        return view('admin.tipodocumentos.index', ['tipodocumentos' => $tipodocumentos]);

    }

    public function create()
    {
        return view('admin.tipodocumentos.create');
    }


    public function store(TipodocumentoRequest $request)
    {
        // Validar o formulário
        $request->validated();

        try {

            Tipodocumento::create([
                'nome' => Str::upper($request->nome),
                'ativo' => $request->ativo,
            ]);

             // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('tipodocumento.index')->with('success', 'Tipo de Documento cadastrado com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Tipo de Documento não cadastrado!');
        }
    }


    // Carregar o formulário editar tipo de documento
    public function edit(Tipodocumento $tipodocumento)
    {
        // carregar a view
        return view('admin.tipodocumentos.edit', ['tipodocumento' => $tipodocumento]);
    }

    // Atualizar no banco de dados o tipo do documento
    public function update(TipodocumentoRequest $request, Tipodocumento $tipodocumento)
    {
        // Validar o formulário
        $request->validated();

        try{
            $tipodocumento->update([
                'nome' => Str::upper($request->nome),
                'ativo' => $request->ativo,
            ]);

            return  redirect()->route('tipodocumento.index')->with('success', 'Tipo de Documento editado com sucesso!');

        } catch(Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Tipo de Documento não editado. Tente outra vez!');

        }

    }


    // Excluir o tipounidade do banco de dados
    public function destroy(Tipodocumento $tipodocumento)
    {
        try {
            // Excluir o registro do banco de dados
            $tipodocumento->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('tipodocumento.index')->with('success', 'Tipo de Documento excluído com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('tipodocumento.index')->with('error', 'Tipo de Documento não excluído!');
        }
    }
}
