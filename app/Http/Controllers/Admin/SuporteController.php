<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requerente;
use App\Models\Documento;
use App\Models\Tipodocumento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class SuporteController extends Controller
{
    // Exibe a lista de Requerentes cujo estatus seja diferente de "em andamento (1)" e "concluído (5)"
    public function indexmudarestatus()
    {
        $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'user'])
            //->where('estatus', '!=', '1')
            //->where('estatus', '!=', '5')
            //->where('estatus', '=', '3')
            ->orderBy('nomecompleto')
            ->paginate(10);

        return view('admin.suporte.requerentesmudarestatus', [
                'requerentes' => $requerentes,
        ]);
    }


    public function updatemudarestatus(Request $request, Requerente $requerente)
    {
        // Implementando a validação dentro do próprio método.
        $validator = Validator::make($request->all(), [
            'novoestatus' => 'required'
        ]);

        if ($validator->fails()) {
            //$request->session()->put('errormudarestatus', true);
            //dd($request->session()->all());
            //return back()->withErrors($validator)->withInput();
            return back()->withErrors(['novoestatus.required' => "Status da requerente: $requerente->nomecompleto não alterado!"])->withInput();
        }else {
            $requerente->update([
                'estatus' => $request->novoestatus
            ]);
        }

        return  redirect()->route('suporte.indexmudarestatus')->with('success', 'Status da Requerente: '.$requerente->nomecompleto.' alterado com sucesso!');

    }


    // Exibe os Requerentes cujo documentos deverãoser excluidos por alguma razão adversa
    public function listarrequerentes()
    {
        $requerentes = Requerente::with(['regional', 'municipio', 'tipounidade', 'unidadeatendimento', 'user'])
            //->where('estatus', '!=', '1')
            //->where('estatus', '!=', '5')
            ->orderBy('nomecompleto')
            ->paginate(10);

        return view('admin.suporte.requerentesexcluirdocumentos', [
                'requerentes' => $requerentes,
        ]);
    }


    public function listardocumentosrequerente(Requerente $requerente)
    {
        // Recuperando os tipos de documentos para compor o campo select
        // $tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        //$tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->where('id', '>', '1')->orderBy('nome', 'ASC')->get();
        $tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        // Recuperando todos os documentos anexados da requerente
        $documentos =  Documento::where('requerente_id', '=', $requerente->id)->orderBy('ordem', 'ASC')->get();

        return view('admin.suporte.excluirdocumento', compact('requerente', 'tiposdocumentos', 'documentos'));
    }


    public function excluirdocumento(Documento $documento)
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


        // Modifica o estatus dependendo da quantidade de documentos exigidos e que foram apagados
        if(Documento::documentosexigidos($requerenteId)){
            // Atualiza o estatus da situação do requerente (1-andamento; 2-análise; 3-pendente; 4-Corrigido, 5-concluído )
            $requerente = Requerente::find($requerenteId);
            $requerente->update([
                'estatus' => 1   // Andamento
            ]);
        }


        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('suporte.listardocumentosrequerente', ['requerente' => $requerenteId])->with('success', 'Documento excluído com sucesso!');
    }


    // Exibe a lista de Requerentes cujo estatus é igual a 5(concluído) para sanitizar pasta documentos
    public function requerentessanitizar()
    {
        $requerentes = Requerente::select(['id', 'nomecompleto', 'estatus', 'created_at'])
            ->where('estatus', '=', '5')
            ->orderBy('created_at')
            ->paginate(10);

        return view('admin.suporte.requerentessanitizar', [
                'requerentes' => $requerentes,
        ]);
    }


    public function sanitizardocumentos(Requerente $requerente)
    {

        // Obtendo o ID do requerente a qual pertence o Documento
        $requerenteId = $requerente->id;

        // Verificando se existe uma pasta com o ID da requerente para poder apagar todos os seus arquivos
        if(Storage::disk('public')->exists('documentos/requerente_'.$requerenteId)) {

            // Retorna um array de trodos os arquivos dentro do diretório
            $files = Storage::disk('public')->files('documentos/requerente_'.$requerenteId);

            $num_arq_deletados = count($files);

            // Deleta o diretório com todos os arquivos existentes
            Storage::disk('public')->deleteDirectory('documentos/requerente_'.$requerenteId);

        }

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('suporte.requerentessanitizar')->with('success', $num_arq_deletados. ' - documentos excluído com sucesso!');

    }



}
