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

        // Recuperando todos os documentos anexados da requerente
        $documentos =  Documento::where('requerente_id', '=', $requerente->id)->orderBy('nome', 'ASC')->get();

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
         // return redirect()->route('documento.index', ['requerente' => $request->requerente_id_hidden])->with('success', 'Documento anexado com sucesso!');
         return redirect()->route('documento.create', ['requerente' => $request->requerente_id_hidden])->with('success', 'Documento anexado com sucesso!');
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

            //Armazenando os caminhos do arquivo mesclado no Banco de Dados
            $documento = new Documento();
            $documento->url = 'documentos/requerente_'.$requerenteId.'/arquivos_mesclados.pdf';
            $documento->nome = "desnecessario";
            $documento->tipodocumento_id =  4;
            $documento->requerente_id = $requerenteId;
            $documento->save();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('documento.index', ['requerente' => $requerenteId])->with('success', 'Documento mesclado com sucesso!');

        }
        
        

    }
    

}
