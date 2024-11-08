<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentoRequest;
use App\Models\Requerente;
use App\Models\Documento;
use App\Models\Tipodocumento;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index(Requerente $requerente)
    {
        // Recuperando todos os documentos anexados da requerente
        $documentos =  Documento::where('requerente_id', '=', $requerente->id)->orderBy('nome', 'ASC')->get();

        return view('admin.documentos.index', compact('requerente', 'documentos'));
    }

    public function create(Requerente $requerente)
    {
        // Recuperando os tipos de documentos para compor o campo select
        $tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        return view('admin.documentos.create', compact('requerente', 'tiposdocumentos'));
    }


    public function store(DocumentoRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Checando se veio a imagem/arquivo na requisição e depois verifica se não houve erro de upload na imagem.
        if($request->hasFile('url')) {

            if($request->url->isValid()) {

                // Armazenando o arquivo fisico no disco public e retornando a url (caminho) do arquivo
                $documentoURL = $request->url->store("documentos/requerente_".$request->requerente_id_hidden, "public");

                //Armazenando os caminhos do arquivo no Banco de Dados
                $documento = new Documento();
                    $documento->url = $documentoURL;
                    $documento->nome = "desnecessario";
                    $documento->tipodocumento_id =  $request->tipodocumento_id;
                    $documento->requerente_id = $request->requerente_id_hidden;
                $documento->save();

            } /* else {
                $request->session()->flash('error', 'Houve umm erro em processaar o arquivo!');
                return redirect()->route('.compra.comprovante.index', $idcompra);
            } */
        } /* else {

            $request->session()->flash('error', 'Houve umm erro em processaar o arquivo!');
            return redirect()->route('admin.compra.comprovante.index', $idcompra);
        } */

         // Redirecionar o usuário, enviar a mensagem de sucesso
         return redirect()->route('documento.index', ['requerente' => $request->requerente_id_hidden])->with('success', 'Documento anexado com sucesso!');
    }


    public function destroy(Documento $documento)
    {

        // Obtendo o ID do requerente a qual pertence o Documento
        $requerenteId = $documento->requerente->id;

        // Apagando fisicamente o arquivo do disco //Storage::delete($comprovante->url); OU
        if(Storage::disk('public')->exists($documento->url)){

            Storage::disk('public')->delete($documento->url);
        }

        // Apagando o registro no banco de dados
        $documento->delete();

        // APAGANDO O DIRETÓRIO, CASO NÃO EXISTA ARQUIVOS NO MESMO
        // Retorna um array de trodos os arquivos dentro do diretório
        $files = Storage::disk('public')->files('documentos/requerente_'.$requerenteId);

        // Se não há arquivos dentro do diretório, deleta o diretório
        if(count($files) == 0){
            Storage::disk('public')->deleteDirectory('documentos/requerente_'.$requerenteId);
        }

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('documento.index', ['requerente' => $requerenteId])->with('success', 'Documento excluído com sucesso!');
    }

}
