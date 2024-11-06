<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AnexoRequest;
use App\Models\Requerente;
use App\Models\Anexo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AnexoController extends Controller
{
    public function index(Requerente $requerente)
    {
        // Recuperando todos os anexos anexos da requerente
        $anexos =  Anexo::where('requerente_id', '=', $requerente->id)->orderBy('nome', 'ASC')->get();

        return view('admin.anexos.index', compact('requerente', 'anexos'));
    }

    public function create(Requerente $requerente)
    {
        return view('admin.anexos.create', compact('requerente'));
    }


    public function store(AnexoRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Checando se veio a imagem/arquivo na requisição e depois verifica se não houve erro de upload na imagem.
        if($request->hasFile('url')) {

            if($request->url->isValid()) {

                // Armazenando o arquivo fisico no disco public e retornando a url (caminho) do arquivo
                $anexoURL = $request->url->store("anexos/requerente_".$request->requerente_id_hidden, "public");

                //Armazenando os caminhos do arquivo no Banco de Dados
                $anexo = new Anexo();
                    $anexo->url = $anexoURL;
                    $anexo->nome = $request->nome;
                    $anexo->requerente_id = $request->requerente_id_hidden;
                $anexo->save();

            } /* else {
                $request->session()->flash('error', 'Houve umm erro em processaar o arquivo!');
                return redirect()->route('.compra.comprovante.index', $idcompra);
            } */
        } /* else {

            $request->session()->flash('error', 'Houve umm erro em processaar o arquivo!');
            return redirect()->route('admin.compra.comprovante.index', $idcompra);
        } */

         // Redirecionar o usuário, enviar a mensagem de sucesso
         return redirect()->route('anexo.index', ['requerente' => $request->requerente_id_hidden])->with('success', 'Anexo cadastrado com sucesso!');
    }


    public function destroy(Anexo $anexo)
    {

        // Obtendo o ID do requerente a qual pertence o Anexo
        $requerenteId = $anexo->requerente->id;

        // Apagando fisicamente o arquivo do disco //Storage::delete($comprovante->url); OU
        if(Storage::disk('public')->exists($anexo->url)){

            Storage::disk('public')->delete($anexo->url);
        }

        // Apagando o registro no banco de dados
        $anexo->delete();

        // APAGANDO O DIRETÓRIO, CASO NÃO EXISTA ARQUIVOS NO MESMO
        // Retorna um array de trodos os arquivos dentro do diretório
        $files = Storage::files('anexos/requerente_'.$requerenteId);

        // Se não há arquivos dentro do diretório, deleta o diretório
        if(count($files) == 0){
            Storage::deleteDirectory('anexos/requerente_'.$requerenteId);
        }

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('anexo.index', ['requerente' => $requerenteId])->with('success', 'Anexo excluído com sucesso!');
    }


}
