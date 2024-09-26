<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MunicipioRequest;
use App\Models\Municipio;
use App\Models\Regional;
use Exception;
use Illuminate\Support\Str;

class MunicipioController extends Controller
{
    public function index()
    {
        // Recuperar os registros do banco dados sem pesquisa
        // $municipios = Municipio::orderByDesc('created_at')->paginate(10);

        $municipios = Municipio::with('regional')->paginate(10);
        return view('municipios.index', ['municipios' => $municipios]);

    }

    public function create()
    {
        $regionais = Regional::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        return view('municipios.create', ['regionais' => $regionais]);
    }


    public function store(MunicipioRequest $request)
    {
        // Validar o formulário
        $request->validated();

        try {

            // Gravar dados no banco
            // Municipio::create($request->all());
            Municipio::create([
                'nome' => Str::upper($request->nome),
                'ativo' => $request->ativo,
                'regional_id' => $request->regional_id,
            ]);

             // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('municipio.index')->with('success', 'Municipio cadastrado com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Município não cadastrado!');
        }
    }


    // Carregar o formulário editar municipio
    public function edit(Municipio $municipio)
    {
        // carregar a view
        $regionais = Regional::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        return view('municipios.edit', ['regionais' => $regionais, 'municipio' => $municipio]);
    }

    // Atualizar no banco de dados a regional
    public function update(MunicipioRequest $request, Municipio $municipio)
    {
        // Validar o formulário
        $request->validated();

        try{
            $municipio->update([
                'nome' => Str::upper($request->nome),
                'ativo' => $request->ativo,
                'regional_id' => $request->regional_id,
            ]);

            return  redirect()->route('municipio.index')->with('success', 'Municipio editado com sucesso!');

        } catch(Exception $e) {

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Municipio não editado. Tente outra vez!');

        }

    }


    // Excluir o municipio do banco de dados
    public function destroy(Municipio $municipio)
    {
        try {
            // Excluir o registro do banco de dados
            $municipio->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('municipio.index')->with('success', 'Municipio excluído com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('municipio.index')->with('error', 'Municipio não excluído!');
        }
    }





}
