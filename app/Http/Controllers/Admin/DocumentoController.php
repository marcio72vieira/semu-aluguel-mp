<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentoRequest;
use App\Http\Requests\ChecklistRequest;
use App\Models\Requerente;
use App\Models\Documento;
use App\Models\Processo;
use App\Models\Tipodocumento;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class DocumentoController extends Controller
{
    public function index(Requerente $requerente)
    {
        // Recuperando todos os documentos anexados da requerente
        $documentos =  Documento::where('requerente_id', '=', $requerente->id)->orderBy('ordem', 'ASC')->get();

        return view('admin.documentos.analise', compact('requerente', 'documentos'));
    }

    public function create(Requerente $requerente)
    {
        // Recuperando os tipos de documentos para compor o campo select
        // $tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();
        //$tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->where('id', '>', '1')->orderBy('nome', 'ASC')->get();
        $tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

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
                    $documento->aprovado =  NULL;       // Não há a necessidade desta atribuição, já que seu valor default é NULL. A obrigação do preenchimento está definida no DocumentoRequest
                    $documento->observacao =  NULL;     // Não há a necessidade desta atribuição, já que seu valor default é NULL. A obrigação do preenchimento está definida no DocumentoRequest
                    $documento->corrigido = NULL;       // Não há a necessidade desta atribuição, já que seu valor default é NULL
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


    public function submeteranalise(Request $request, Requerente $requerente)
    {
        // Atualiza o campo status conforme a necessidade
        $requerente->update([
            'status' => $request->status_hidden
        ]);

        // Redirecionar o usuário(Assistente Social), enviar a mensagem de sucesso
        return redirect()->route('requerente.index')->with('success', 'Documentos submetidos para análise com sucesso!');

    }


    // Aprovaçãod do Checklist
    // public function update(ChecklistRequest $request)
    public function efetuaanalisegeraprocesso(ChecklistRequest $request)
    {

        // NOTA: Transformando o retorno de "$request_all()" em uma "collect" e aplicando o método "count" da "collect" para saber quantos registros possui
        //$campos =  collect($request->all())->count();

        // Transformando o valor do campo array_ids_documentos_hidden(que vem como uma string, aglutinando todos os ids dos registros), em um array novamente
        $ids =  explode(',', $request->array_ids_documentos_hidden);

        // Total de documentos analisados, independente de terem sidos aprovados ou não
        $totalDocumentos = sizeof($ids);

        // Acumulador para todos os documentos aprovados
        $totalDocumentosAprovados = 0;

        // Iterando sobre os documentos para saber se o mesmo foram aprovados ou não
        foreach($ids as $id){

            // Se aprovados soma mais um
            if($request["aprovado_$id"] == 1){
                $totalDocumentosAprovados = $totalDocumentosAprovados + 1;
            }
        }

        // Verifica se todos os documentos analisados foram aprovados. Se  verdade (gera o processo). Se falso (retorna para correção)
        if($totalDocumentosAprovados ==  $totalDocumentos){

            // INICIO SALVAR PROCESSO

            // Se todos os documentos foram aprovados, atualiza os campos APROVADDO para "1", CORRIGIDO para "null" e OBSERVACAO para "null"
            // e atribui a correção dos documentos ao usuário (Servidor da SEMU) logado e responsável pela geração do processo.
            foreach($ids as $id){
                // Recupera o documento
                $documento = Documento::find($id);

                // Atualiza os campos necessários
                $documento->update([
                    'aprovado'      => 1,
                    'corrigido'     => null,
                    'observacao'    => null,
                    'user_id'       => Auth::user()->id
                ]);
            }


            // Cria um diretório "processos", caso o diretório não exista.
            if(!Storage::exists("processos")){
                //Storage::makeDirectory($path, 0777, true, true);
                Storage::disk('public')->makeDirectory("processos");
            }


            // Obtendo o REQUERENTE através do campo id_requerene_hidden a qual pertencerá o processo
            $requerente = Requerente::find($request->requerente_id_hidden);

            // Obtendo o id do requerente em questão
            $requerenteId = $requerente->id;

            // Retorna um array de todos os arquivos dentro do diretório do requerente em questão
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

            // Criar um aquivo vazio no diretório atual.
            // file_put_contents(getcwd() . "/storage/documentos/requerente_".$requerenteId."/arquivos_mesclados.pdf", "");
            // file_put_contents(getcwd() . "/storage/processos/processo_".$requerenteId.".pdf", "");
            file_put_contents(getcwd() . "/storage/processos/processo_$requerenteId.pdf", "");

            // Obs: O "espaço em branco" no final do comando é fundamental para o funcionamento do mesmos.
            // $command = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . getcwd() . "/storage/documentos/requerente_".$requerenteId."/arquivos_mesclados.pdf ";
            // $command = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . getcwd() . "/storage/processos/processo_".$requerenteId.".pdf ";
            $command = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . getcwd() . "/storage/processos/processo_$requerenteId.pdf ";


            // Iterando sobre os arquivos, na pasta original onde os mesmos se encontram.
            // Resgata o conteúdo de cada arquivo para mesclar no arquivo final. Observe o "espaco em branco" no final do comando.
            foreach ($arraySoComONomeDosArquivos as $file) {
                $command .= getcwd() . "/storage/documentos/requerente_".$requerenteId."/" . $file . " ";
            }

            $command .= "2&>1";

            $result = shell_exec($command);


            if($result){
                // Obtém o id do usuario (Assistente Social) que anexou os documentos. Durante a análise, este id do usuário (Assistente Social) será substituido pelo id do usuário (Servidor da SEMU)
                // responsável pela Análise dos Documentos anexado. O id do usuário (Assistente Social) que anexou os documentos, poderá ser recuperado através da relação Requerente X Usuário

                // Id do Funcionáro da SEMU
                $user = Auth::user();
                $user = User::find($user->id);
                $idUsuario = $user->id;
                $nomeUsuario = $user->nomecompleto;

                // Formação de Arrays dos campos selects
                $arr_comunidade = ['1' => 'Cigano', '2' => 'Quilombola', '3' => 'Matriz Africana', '4' => 'Indígena', '5' => 'Assentado / acampado', '6' => 'Pessoa do campo / floresta', '7' => 'Pessoa em situação de rua', '20' => 'Outra'];
                $arr_racacor = ['1' => 'Branca', '2' => 'Preta', '3' => 'Amarela', '4' => 'Parda', '5' => 'Indígena', '6' => 'Não se aplica', '20' => 'Outra'];
                $arr_identidadegenero = ['1' => 'Feminino', '2' => 'Transexual', '3' => 'Travesti', '4' => 'Transgênero', '20' => 'Outra'];
                $arr_orientacaosexual = ['1'=>'Homossexual', '2'=>'Heterossexual', '3'=>'Bissexual', '20'=>'Outra'];
                $arr_deficiente = ['0' => 'não', '1' => 'sim'];
                $arr_estadocivil = ['1' => 'Solteira', '2' => 'Casada', '3' => 'Divorciada', '4' => 'Viúva', '20' => 'Outro'];

                //Armazenando o caminho do arquivo mesclado (processo gerado) no Banco de Dados na tabela "processos"
                $processo = new Processo();
                    //$processo->url = 'documentos/requerente_'.$requerenteId.'/arquivos_mesclados.pdf';
                    $processo->url = 'processos/processo_'.$requerenteId.'.pdf';

                    $processo->requerente_id = $requerente->id;
                    $processo->nomecompleto = $requerente->nomecompleto;
                    $processo->rg = $requerente->rg;
                    $processo->orgaoexpedidor = $requerente->orgaoexpedidor;
                    $processo->cpf = $requerente->cpf;
                    $processo->banco = $requerente->banco;
                    $processo->agencia = $requerente->agencia;
                    $processo->conta = $requerente->conta;
                    $processo->contaespecifica = $requerente->contaespecifica;
                    $processo->comunidade_id = $requerente->comunidade;
                    $processo->comunidade = $arr_comunidade[$requerente->comunidade];
                    $processo->outracomunidade = $requerente->outracomunidade;
                    $processo->racacor_id = $requerente->racacor;
                    $processo->racacor = $arr_racacor[$requerente->racacor];
                    $processo->outraracacor = $requerente->outraracacor;
                    $processo->identidadegenero_id = $requerente->identidadegenero;
                    $processo->identidadegenero = $arr_identidadegenero[$requerente->identidadegenero];
                    $processo->outraidentidadegenero = $requerente->outraidentidadegenero;
                    $processo->orientacaosexual_id = $requerente->orientacaosexual;
                    $processo->orientacaosexual = $arr_orientacaosexual[$requerente->orientacaosexual];
                    $processo->outraorientacaosexual = $requerente->outraorientacaosexual;
                    $processo->deficiente_id = $requerente->deficiente;
                    $processo->deficiente = $arr_deficiente[$requerente->deficiente];
                    $processo->deficiencia = $requerente->deficiencia;
                    $processo->sexobiologico = $requerente->sexobiologico;
                    $processo->nacionalidade = $requerente->nacionalidade;
                    $processo->profissao = $requerente->profissao;
                    $processo->estadocivil_id = $requerente->estadocivil;
                    $processo->estadocivil = $arr_estadocivil[$requerente->estadocivil];
                    $processo->endereco = $requerente->endereco;
                    $processo->numero = $requerente->numero;
                    $processo->complemento = $requerente->complemento;
                    $processo->bairro = $requerente->bairro;
                    $processo->cep = $requerente->cep;
                    $processo->foneresidencial = $requerente->foneresidencial;
                    $processo->fonecelular = $requerente->fonecelular;
                    $processo->email = $requerente->email;
                    $processo->regional_id = $requerente->regional_id;
                    $processo->regional = $requerente->regional->nome;
                    $processo->municipio_id = $requerente->municipio_id;
                    $processo->municipio = $requerente->municipio->nome;
                    $processo->tipounidade_id = $requerente->tipounidade_id;
                    $processo->tipounidade = $requerente->tipounidade->nome;
                    $processo->unidadeatendimento_id = $requerente->unidadeatendimento_id;
                    $processo->unidadeatendimento = $requerente->unidadeatendimento->nome;
                    $processo->datacadastro = $requerente->created_at;                          // data em que a Requerente foi cadastrada no Sistema

                    // campos referene ao processo judicial e ao questionário
                    $processo->processojudicial = $requerente->detalhe->processojudicial;
                    $processo->orgaojudicial = $requerente->detalhe->orgaojudicial;
                    $processo->comarca = $requerente->detalhe->comarca;
                    $processo->prazomedidaprotetiva = $requerente->detalhe->prazomedidaprotetiva;
                    $processo->dataconcessaomedidaprotetiva = $requerente->detalhe->dataconcessaomedidaprotetiva;
                    $processo->medproturgcaminhaprogoficial = $requerente->detalhe->medproturgcaminhaprogoficial;
                    $processo->medproturgafastamentolar = $requerente->detalhe->medproturgafastamentolar;
                    $processo->riscmortvioldomesmoradprotegsigilosa = $requerente->detalhe->riscmortvioldomesmoradprotegsigilosa;
                    $processo->riscvidaaguardmedproturg = $requerente->detalhe->riscvidaaguardmedproturg;
                    $processo->relatodescomprmedproturgagressor = $requerente->detalhe->relatodescomprmedproturgagressor;
                    $processo->sitvulnerabnaoconsegarcardespmoradia = $requerente->detalhe->sitvulnerabnaoconsegarcardespmoradia;
                    $processo->temrendfamiliardoissalconvivagressor = $requerente->detalhe->temrendfamiliardoissalconvivagressor;
                    $processo->paiavofilhonetomaiormesmomunicipresid = $requerente->detalhe->paiavofilhonetomaiormesmomunicipresid;
                    $processo->parentesmesmomunicipioresidencia = $requerente->detalhe->parentesmesmomunicipioresidencia;
                    $processo->filhosmenoresidade = $requerente->detalhe->filhosmenoresidade;
                    $processo->trabalhaougerarenda = $requerente->detalhe->trabalhaougerarenda;
                    $processo->valortrabalhorenda = $requerente->detalhe->valortrabalhorenda;
                    $processo->temcadunico = $requerente->detalhe->temcadunico;
                    $processo->teminteresformprofisdesenvolvhabilid = $requerente->detalhe->teminteresformprofisdesenvolvhabilid;
                    $processo->apresentoudocumentoidentificacao = $requerente->detalhe->apresentoudocumentoidentificacao;
                    $processo->cumprerequisitositensnecessarios = $requerente->detalhe->cumprerequisitositensnecessarios;

                    // Campos referente ao Assisente Social, responsável pelo cadastro e ao Servidor da SEMU, responsavel pelo checklist
                    $processo->assistente_id = $requerente->user->id;
                    $processo->assistente = $requerente->user->nomecompleto;
                    $processo->funcionariosemu_id = $idUsuario;
                    $processo->funcionario = $nomeUsuario;

                $processo->save();

                // Atualiza o status da situação do requerente (1-andamento; 2-análise; 3-pendnete; 4-corrigido; 5-concluido )
                $requerente = Requerente::find($request->requerente_id_hidden);
                $requerente->update([
                    'status' => 5   // Concluído
                ]);

                // Redirecionar o usuário, enviar a mensagem de sucesso
                // return redirect()->route('documento.index', ['requerente' => $requerenteId])->with('success', 'PROCESSO gerado com sucesso!');
                return redirect()->route('processo.index')->with('success', 'PROCESSO gerado com sucesso!');

            }

            // FIM SALVAR PROCESSO

        }else{

            // Define o campo status (na tabela requerente) para 3 (pendente), e atualiza na tabela documentos os demais campos referente a análise

            // Validar o formulário
            $request->validated();

            // Marcar o ponto inicial de uma transação
            DB::beginTransaction();

            try {

                // Recuperando o usuário autenticado responsavel pela análise dos documentos
                $user = Auth::user();
                $user = User::find($user->id);
                $idAnalista = $user->id;    // Responsável pela análise dos documentos

                // Transformando o valor do camo array_ids_documentos_hidden(que vem como uma string), em um array novamente
                $ids =  explode(',', $request->array_ids_documentos_hidden);

                foreach($ids as $id){
                    // Recupera o documento
                    $documento = Documento::find($id);

                    // Atualiza os campos necessários
                    $documento->update([
                        'aprovado'      => $request["aprovado_$id"],
                        'corrigido'     => null,
                        'observacao'    => $request["observacao_$id"],
                        'user_id'       => $idAnalista
                    ]);
                }

                // Atualiza o status da situação do requerente (1-andamento; 2-análise; 3-pendente; 4-Corrigido, 5-concluído )
                $requerente = Requerente::find($request->requerente_id_hidden);
                $requerente->update([
                    'status' => 3   // Pendente
                ]);

                // Operação concluída com êxito
                DB::commit();

                // Redirecionar o usuário, enviar a mensagem de sucesso
                // return redirect()->route('requerente.index')->with('success', 'Análise efetuada com sucesso!');
                return redirect()->route('checklist.index')->with('success', 'Análise efetuada com sucesso!');

            } catch (Exception $e) {

                // Operação não é concluiída com êxito
                DB::rollBack();

                // Redirecionar o usuário, enviar a mensagem de erro
                return back()->withInput()->with('error', 'Análise não efetuada, tente mais tarde!'. $e->getMessage());
            }
        }

        /*
        foreach($ids as $id){

            //echo $request["aprovado_$id"]."<br>";
            //echo $request["observacao_$id"]."<br>";

            if($request["aprovado_$id"] == 0){
                echo "Documento: ". $id . ", ". $request["observacao_$id"] ."<br>";
            }
        }
        */

    }


    public function pendentes(Requerente $requerente)
    {
        // Recuperando todos os documentos anexados da requerente com suas devias pendências (observações)
        // Obs: analisar se não seria melhor exibir só os documentos com pendência ao invés de todos os documentos novamente.
        $tiposdocumentos = Tipodocumento::where('ativo', '=', '1')->orderBy('nome', 'ASC')->get();

        // Recuperando todos os documentos anexados da requerente
        $documentos =  Documento::where('requerente_id', '=', $requerente->id)->where('aprovado', '=', 0)->orderBy('ordem', 'ASC')->get();
        //$documentos =  Documento::where('requerente_id', '=', $requerente->id)->orderBy('ordem', 'ASC')->get();

        return view('admin.documentos.pendencia', compact('requerente', 'tiposdocumentos', 'documentos'));
    }


    // INICIO REPLACE
    public function replace(DocumentoRequest $request)
    {
        //dd($request->all());

        // Validar o formulário
        $request->validated();



        // Checando se veio a imagem/arquivo na requisição e depois verifica se não houve erro de upload na imagem.
        if($request->hasFile('url')) {

            if($request->url->isValid()) {

                //dd($request->all());

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

                $nomedocumento = $request->nome_documento_hidden;

                $file = $request->url;
                $tempo = time();
                $pathAndFileName = "documentos/requerente_". $request->requerente_id_hidden ."/doc_". $ordem ."_". $tempo .".". $file->getClientOriginalExtension();
                Storage::disk('public')->put($pathAndFileName, file_get_contents($file));

                // Obtém o id do usuario (Assistente Social) que está atualizando os documentos(arquivos), visto quê um profissional Assistente Social,
                // pode dar continuidade no trabalho iniciado por outra.
                $user = Auth::user();
                $user = User::find($user->id);
                $idUsuario = $user->id;

                // Atualizando o caminho do novo arquivo fisico no Banco de Dados e as demais informações sobre Documentos que se fazem necessárias
                $documento =  Documento::find($request->documento_id);

                // Atualização original com o id do Assistente Social que Atualizou os documentos (DESNECESSÁRIO, pois inibeo nome do Servidor da SEMU que fez a análise dos documentos)
                //$documento->update([
                //    'url'       => $pathAndFileName,
                //    'corrigido' => 1,
                //    'user_id'   => $idUsuario,
                //]);

                $documento->update([
                    'url'       => $pathAndFileName,
                    'corrigido' => 1,
                ]);
            }

            // Apagando fisicamente o arquivo antigo do disco
            if(Storage::disk('public')->exists("documentos/requerente_$request->requerente_id_hidden/$request->nome_arquivo_antigo")){
                Storage::disk('public')->delete("documentos/requerente_$request->requerente_id_hidden/$request->nome_arquivo_antigo");
            }

        }

         // Redirecionar o usuário, enviar a mensagem de sucesso
         return redirect()->route('documento.pendentes', ['requerente' => $request->requerente_id_hidden])->with("success", "Documento: $nomedocumento, atualizado com sucesso!");
    }


    // FIM REPLACE


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


        // Modifica o status dependendo da quantidade de documentos exigidos e que foram apagados
        if(Documento::documentosexigidos($requerenteId)){
            // Atualiza o status da situação do requerente (1-andamento; 2-análise; 3-pendente; 4-Corrigido, 5-concluído )
            $requerente = Requerente::find($requerenteId);
            $requerente->update([
                'status' => 1   // Andamento
            ]);
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
