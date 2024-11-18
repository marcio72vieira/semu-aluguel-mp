<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentoRequest;
use App\Http\Requests\ChecklistRequest;
use App\Models\Requerente;
use App\Models\Documento;
use App\Models\Tipodocumento;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index(Requerente $requerente)
    {
        // Recuperando todos os documentos anexados da requerente
        $documentos =  Documento::where('requerente_id', '=', $requerente->id)->orderBy('ordem', 'ASC')->get();

        return view('admin.documentos.checklist', compact('requerente', 'documentos'));
    }

    public function create(Requerente $requerente)
    {
        // Recuperando os tipos de documentos para compor o campo select
        // $tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        $tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->where('id', '>', '1')->orderBy('nome', 'ASC')->get();

        // Recuperando todos os documentos anexados da requerente
        $documentos =  Documento::where('requerente_id', '=', $requerente->id)->orderBy('ordem', 'ASC')->get();

        return view('admin.documentos.create', compact('requerente', 'tiposdocumentos', 'documentos'));
    }


    public function store(DocumentoRequest $request)
    {

        // Validar o formulário
        $request->validated();

        // Checando se veio a imagem/arquivo na requisição e depois verifica se não houve erro de upload na imagem.
        if($request->hasFile('url')) {

            if($request->url->isValid()) {

                // Armazenando o arquivo fisico no disco public e retornando a url (caminho) do arquivo
                // $documentoURL = $request->url->store("documentos/requerente_".$request->requerente_id_hidden, "public");

                //$file = $request->url;
                //$documentoURL = Storage::disk('public')->put("documentos/requerente_".$request->requerente_id_hidden, $file);

                // Obs: Na situação: doc_1_1020304050 e doc_10_1020304051, o documento doc_10_1020304051 será impresso primeiro
                // por isso é necessário o trecho de script abaixo. Se orodem = 1 fica 01, ordem = 2 fica 02 etc...
                if(strlen($request->tipodocumento_ordem_hidden) == 1){
                    $ordem = "0".$request->tipodocumento_ordem_hidden;
                }else{
                    $ordem = $request->tipodocumento_ordem_hidden;
                }

                $file = $request->url;
                $tempo = time();
                $pathAndFileName = "documentos/requerente_". $request->requerente_id_hidden ."/doc_". $ordem ."_". $tempo .".". $file->getClientOriginalExtension();
                //$documentoURL = Storage::disk('public')->put($pathAndFileName, file_get_contents($file));
                Storage::disk('public')->put($pathAndFileName, file_get_contents($file));

                //Armazenando os caminhos do arquivo no Banco de Dados e as demais informações sobre o Documento anexado

                // Obtém o id do usuario (Assistente Social) que anexou os documentos. Durante a análise, este id do usuário (Assistente Social) será substituido pelo id do usuário (Servidor da SEMU)
                // responsável pela Análise dos Documentos anexado. O id do usuário (Assistente Social) que anexou os documentos, poderá ser recuperado através da relação Requerente X Usuário
                $user = Auth::user();
                $user = User::find($user->id);
                $idUsuario = $user->id;


                $documento = new Documento();
                    //$documento->url = $documentoURL;
                    $documento->ordem = $request->tipodocumento_ordem_hidden;
                    $documento->url = $pathAndFileName;
                    $documento->tipodocumento_id =  $request->tipodocumento_id;
                    $documento->aprovado =  1;          // Não há a necessidade desta atribuição, já que seu valor default é 1
                    $documento->observacao =  NULL;     // Não há a necessidade desta atribuição, já que seu valor default é NULL
                    $documento->requerente_id = $request->requerente_id_hidden;
                    $documento->user_id = $idUsuario;
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
         // return redirect()->route('documento.index', ['requerente' => $request->requerente_id_hidden])->with('success', 'Documento anexado com sucesso!');
         return redirect()->route('documento.create', ['requerente' => $request->requerente_id_hidden])->with('success', 'Documento anexado com sucesso!');
    }


    // Aprovaçãod do Checklist
    // public function update(ChecklistRequest $request)
    public function update(ChecklistRequest $request)
    {
        // Transformao retorno de $request_all() em uma collect e aplica o método count da collect
        //$campos =  collect($request->all())->count();

        //dd($request);

        // Validar o formulário
        $request->validated();



        // Transformando o valor do camo array_ids_documentos_hidden(que vem como uma string), em um array novamente
        $ids =  explode(',', $request->array_ids_documentos_hidden);

        foreach($ids as $id){

            //echo $request["aprovado_$id"]."<br>";
            //echo $request["observacao_$id"]."<br>";

            if($request["aprovado_$id"] == 0){
                echo "Documento: ". $id . ", ". $request["observacao_$id"] ."<br>";
            }
        }

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
        return redirect()->route('documento.create', ['requerente' => $requerenteId])->with('success', 'Documento excluído com sucesso!');
    }


    /*
    public function merge(Requerente $requerente)
    {
        // configuração da pasta publica na minha máquina VAIO antes do chomod 777 ./public:
        // drwxr-xr-x  6 marcio marcio   4096 nov  9 12:10 public/
        // configuração da pasta publica na minha máquina VAIO depois do chomod 777 ./public:
        // drwxrwxrwx  6 marcio marcio   4096 nov  9 12:10 public/

        // <div style="width: 90px; float: left; text-align: center;" >
        //     <!-- { if (file_exists(public_path('img/dummy.jpg'))) { dd('File is Exists '); }else{ dd('File is Not Exists');}} -->
        //     @if($associado->imagem !== null)
        //         @if(file_exists(base_path().'/storage/app/public/'.$associado->imagem))
        //                 <img src="{{ base_path().'/storage/app/public/'.$associado->imagem}}" width="90" style="padding: 2px;">
        //         @else
        //                 <img src="{{ base_path().'/public/images/no-photo.png'}}" width="90" style="padding: 2px;">
        //         @endif
        //     @else
        //         <img src="{{ base_path().'/public/images/no-photo.png'}}" width="90" style="padding: 2px;">
        //     @endif
        // </div>
        // $file = "public/fotos/coletor". $idassociado . '.png';
        // $path = "fotos/coletor". $idassociado . '.png';
        // $success = Storage::put($file, $data);


        // public base url
        // echo url('/');
        // public assets url
        // echo asset('assets/arrow.svg');
        // echo __DIR__;
        // echo base_path();

         // Obtendo o ID do requerente a qual pertence o Documento
         //$requerenteId = $requerente->id;

        // Retorna um array de trodos os arquivos dentro do diretório do requerente em questão
        //$files = glob(Storage::disk('public')->files('documentos/requerente_'.$requerenteId));
        // $files = Storage::disk('public')->files('documentos/requerente_'.$requerenteId);

        // $arquivosPdf = [];
        // foreach($files as $file) {
        //     $arraynomearquivo = explode("/",$file);
        //     $nomearquivo = $arraynomearquivo[2];
        //     $arquivosPdf[] = $nomearquivo;
        // }


        // echo "<pre>";
        //     var_dump($files);
        // echo "</pre>";

        // $output_file = 'arquivo_mesclado.pdf';

         // Armazenando o arquivo fisico no disco public e retornando
         //$cmd = "gs -q -dNOPAUSE -dBATCH -dPrinted=false -sDEVICE=pdfwrite -dColorConversionStrategy=/LeaveColorUnchanged -dDownsampleMonoImages=false -dDownsampleGrayImages=false -dDownsampleColorImages=false -dAutoFilterColorImages=false -dAutoFilterGrayImages=false -dColorImageFilter=/FlateEncode -dGrayImageFilter=/FlateEncode -dEncodeColorImages=false -dEncodeGrayImages=false -dEncodeMonoImages=false -sOutputFile=$output_file ";
         //$cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$output_file ";


        foreach ($arquivosPdf as $file) {
            $cmd .= " $file";
        }


        // $caminho = __DIR__.'storage/app/public/documentos/requerente_1/';
        // $caminho = base_path().'/storage/app/public/documentos/requerente_1/';
        // echo $caminho;
        // dd();

        // foreach ($arquivosPdf as $file) {
        //     $cmd .= " $caminho.$file";
        // }

        // shell_exec($cmd);
    }
    */

    public function merge(Requerente $requerente)
    {
        // Obtendo o ID do requerente a qual pertence o Documento
        $requerenteId = $requerente->id;

        // Retorna um array de trodos os arquivos dentro do diretório do requerente em questão
        $arquivosDaPasta = Storage::disk('public')->files('documentos/requerente_'.$requerenteId);

        // Array para conter apenas o nome dos arquivos da pasta
        $arraySoComONomeDosArquivos = [];

        // Extraindo só o nome dos arquivos da pasta.
        // O nome do arquivo está na poscião [2] da estrutura documentos/requerente_id/nome_do_arquivo.pdf
        foreach($arquivosDaPasta as $arquivo) {
            $arrayExplode =  explode("/", $arquivo);
            $arquivoPdf = $arrayExplode[2];
            $arraySoComONomeDosArquivos[] = $arquivoPdf;
        }

        // Criar um aquivo vazio o diretório atual.
        file_put_contents(getcwd() . "/storage/documentos/requerente_".$requerenteId."/arquivos_mesclados.pdf", "");

        $command = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . getcwd() . "/storage/documentos/requerente_".$requerenteId."/arquivos_mesclados.pdf ";

        foreach ($arraySoComONomeDosArquivos as $file) {
            $command .= getcwd() . "/storage/documentos/requerente_".$requerenteId."/" . $file . " ";
        }

        $command .= "2&>1";

        $result = shell_exec($command);


        if($result){
            // Obtém o id do usuario (Assistente Social) que anexou os documentos. Durante a análise, este id do usuário (Assistente Social) será substituido pelo id do usuário (Servidor da SEMU)
            // responsável pela Análise dos Documentos anexado. O id do usuário (Assistente Social) que anexou os documentos, poderá ser recuperado através da relação Requerente X Usuário
            $user = Auth::user();
            $user = User::find($user->id);
            $idUsuario = $user->id;

            //Armazenando os caminhos do arquivo mesclado no Banco de Dados
            $documento = new Documento();
                $documento->ordem = 20;
                $documento->url = 'documentos/requerente_'.$requerenteId.'/arquivos_mesclados.pdf';
                $documento->tipodocumento_id = 1;
                $documento->aprovado =  1;          // Não há a necessidade desta atribuição, já que seu valor default é 1
                $documento->observacao =  NULL;     // Não há a necessidade desta atribuição, já que seu valor default é NULL
                $documento->requerente_id = $requerenteId;
                $documento->user_id = $idUsuario;
            $documento->save();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('documento.index', ['requerente' => $requerenteId])->with('success', 'Documento mesclado com sucesso!');

        }



    }


}
