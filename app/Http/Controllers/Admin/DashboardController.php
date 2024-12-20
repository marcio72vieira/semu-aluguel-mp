<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regional;
use App\Models\Municipio;
use App\Models\Tipounidade;
use App\Models\Unidadeatendimento;
use App\Models\Tipodocumento;
use App\Models\Requerente;
use App\Models\User;
use App\Models\Processo;
use App\Models\Dashboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelWriter;

class DashboardController extends Controller
{
    public function index()
    {
        $statusreq = [
            '1' => 'Andamento', '2' => 'Análise', '3' => 'Pendente', '4' => 'Corrigido', '5' => 'Concluído'
        ];

        $categorias = [
            '1' => 'Sexo Biológico', '2' => 'Comunidade', '3' => 'Cor/Raça', '4' => 'Identidade de Gênero', '5' => 'Orientação Sexual', '6' => 'Deficiente', '7' => 'Estado Civil'
        ];

        // Definindo mês para computo dos dados OK!
        // $mes_corrente = date('m');   // número do mês no formato 01, 02, 03, 04 ..., 09, 10, 11, 12
        $mes_corrente = date('n');      // número do mês no formato 1, 2, 3, 4 ..., 9, 10, 11, 12
        $ano_corrente = date('Y');

        // Meses e anos para popular campos selects. 
        // Obs: os índices do array não pode ser: 01, 02, 03, etc... por isso a configuração acima: $mes_corrente = date('n');
        //      caso os índices pudesser ser: 01, 02, 03, etc..., seria nno formato: $mes_corrente = date('m');
        $mesespesquisa = [
            '1' => 'janeiro', '2' => 'fevereiro', '3' => 'março', '4' => 'abril', '5' => 'maio', '6' => 'junho',
            '7' => 'julho', '8' => 'agosto', '9' => 'setembro', '10' => 'outubro', '11' => 'novembro', '12' => 'dezembro'
        ];

        $anoimplantacao = 2024;
        $anoatual = date("Y");
        $anospesquisa = [];
        $anos = [];

        if($anoimplantacao >= $anoatual){
            $anospesquisa[] = $anoatual;
        }else{
            $qtdanosexibicao = $anoatual - $anoimplantacao;
            for($a = $qtdanosexibicao; $a >= 0; $a--){
                $anos[] = $anoatual - $a;   // $anoatual - 0 (quando $a for igual a zero) será igual ao ano corrente.
            }
            $anospesquisa = array_reverse($anos);
        }
        
        // Obtendo os todais de entidades do sistema para os Cards
        $totRegionais               =  Dashboard::totalRegionais();
        $totMunicipios              =  Dashboard::totalMunicipios();
        $totTipounidades            =  Dashboard::totalTipounidades();
        $totUnidades                =  Dashboard::totalUnidades();
        $totTipodocumentos          =  Dashboard::totalTipodocumentos();
        $totRequerentes             =  Dashboard::totalRequerentes();
        $totEstatusAndamento        =  Dashboard::totalRequerentesAndamento();
        $totEstatusAnalise          =  Dashboard::totalRequerentesAnalise();
        $totEstatusPendente         =  Dashboard::totalRequerentesPendente();
        $totEstatusCorrigido        =  Dashboard::totalRequerentesCorrigido();
        $totEstatusConcluido        =  Dashboard::totalRequerentesConcluido();
        $totProcessos               =  Dashboard::totalProcessos();
        $totProcessosMesAnoCorrente =  Dashboard::totalProcessosMesAnoCorrente();     // Total de processos do Mês e Ano correntes
        $totUsuarios                =  Dashboard::totalUsuarios();


        //----------Trecho de código referente ao gráfico de Linha ou Área
        //Dados StatusRequerente para gráfico de Linha padrão, ou seja, logo que a Dashboard é carregada
        $recordsestatusrequerente = ['Andamento' => 0, 'Análise' => 0, 'Pendente' => 0, 'Corrigido' => 0, 'Concluído' => 0];
        
        // Desconsidera o ano e o mẽs corrente
        // $recordsEstatus = DB::select("SELECT COUNT(id) as quantidade, status as estatus FROM requerentes GROUP BY status ORDER BY COUNT(id) DESC");
        // Leva em consideração o ano e o mês corrente
        // $recordsEstatus = DB::select("SELECT COUNT(id) as quantidade, status as estatus FROM requerentes WHERE YEAR(created_at) = $ano_corrente AND MONTH(created_at) = $mes_corrente  GROUP BY status ORDER BY COUNT(id) DESC");
        // Leva em consideração apenas o ano corrente
        $recordsEstatus = DB::select("SELECT COUNT(id) as quantidade, status as estatus FROM requerentes WHERE YEAR(created_at) = $ano_corrente GROUP BY status ORDER BY COUNT(id) DESC");
        
        if($recordsEstatus > 0){
            foreach($recordsEstatus as $key => $value){
                if($value->estatus == 1){
                    $recordsestatusrequerente['Andamento'] = $value->quantidade;
                }
                if($value->estatus == 2){
                    $recordsestatusrequerente['Análise'] = $value->quantidade;
                }
                if($value->estatus == 3){
                    $recordsestatusrequerente['Pendente'] = $value->quantidade;
                }
                if($value->estatus == 4){
                    $recordsestatusrequerente['Corrigido'] = $value->quantidade;
                }
                if($value->estatus == 5){
                    $recordsestatusrequerente['Concluído'] = $value->quantidade;
                }
            }
        }else{
            $recordsestatusrequerente = ['Andamento' => 0, 'Análise' => 0, 'Pendente' => 0, 'Corrigido' => 0, 'Concluído' => 0];
        }


        //----------Trecho de código referente ao gráfico de Pizza ou Rosca
        // Leva em consideração o ano e o mês corrente (tabela requerentes)
        // $recordsCategorias = DB::select("SELECT COUNT(id) as quantidade, sexobiologico as sexo FROM requerentes WHERE MONTH(created_at) = $mes_corrente  AND YEAR(created_at) = $ano_corrente GROUP BY sexobiologico ORDER BY COUNT(id) DESC");
        // Leva em consideração apenas o ano corrente (tabela processos)
        // $recordsCategorias = DB::select("SELECT COUNT(id) as quantidade, sexobiologico as sexo FROM processos WHERE YEAR(created_at) = $ano_corrente GROUP BY sexobiologico ORDER BY COUNT(id) DESC");
        // Leva em consideração o ano e o mês corrente (tabela processos)
        $recordsCategorias = DB::select("SELECT COUNT(id) as quantidade, sexobiologico as sexo FROM processos WHERE YEAR(created_at) = $ano_corrente AND MONTH(created_at) = $mes_corrente GROUP BY sexobiologico ORDER BY COUNT(id) DESC");


        //----------Trecho de código referente ao gráfico de colunas
        // Definindo os totais iniciais dos requerimentos mês a mês
        $recordsprocessosmesames  = ['1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0];

        //Recuperando todos os requerimentos concluidos (ou seja, que tornaram-se processos) independente de Regional, Município, Unidade de Atendimento etc...
        $recordsProcessosmeses = DB::select("SELECT MONTH(created_at) as mes, COUNT(id) as quantidade FROM processos WHERE YEAR(created_at) = $ano_corrente GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");

        if($recordsProcessosmeses > 0){
            foreach($recordsProcessosmeses as $value){
                // Atribui/Substitui no índice [1, 2, 3, 4...] referente ao mês,  o respectivo valor referente a quantidade de requerimentos do mês
                $recordsprocessosmesames[$value->mes] = $value->quantidade;
            }
        }else{
            // Se nada for retornado, todos os valores (correspondente aos índices dos mêses) serão 0 (zero)
            $recordsprocessosmesames  = ['1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0];
        }



        // Início - Ignite
        // Obs: Os dados para os demais gráficos, já são zerados por "natureza', caso nenhum dado seja retornado.
        // Categoria Requerente
        $dataRecordsCategorias = [];
        if(count($recordsCategorias) > 0){
            foreach($recordsCategorias as $value) {
                $dataRecordsCategorias[Str::upper($value->sexo)] =  $value->quantidade;
            }
        }else{
            $dataRecordsCategorias[''] =  0;
        }
       
        // Recuperando todos os processos para a tabela de PROCESSOS
        $processos =  Dashboard::processos();

        return view('admin.dashboard.index', compact(
            'categorias',
            'mes_corrente','ano_corrente','mesespesquisa', 'anospesquisa',
            'totRegionais', 'totMunicipios', 'totTipounidades', 'totUnidades', 'totTipodocumentos', 'totUsuarios', 
            'totRequerentes', 'totEstatusAndamento', 'totEstatusAnalise', 'totEstatusPendente', 'totEstatusCorrigido', 'totEstatusConcluido',
            'totProcessos', 'totProcessosMesAnoCorrente',
            'recordsestatusrequerente' ,'dataRecordsCategorias', 'recordsprocessosmesames',
            'processos',
        ));
    }


    public function ajaxgetcategoriachartpie(Request $request)
    {
        // Obtendo os dados vindo na requisição ajax/json
        $cat_corrente = $request->categoria;
        $mes_especifico = $request->mescorrente;
        $ano_especifico = $request->anocorrente;

        $data = [];
        $dataRecordsCategorias = [];
        $records = "";

        // Número total de registros de processos no banco de dados
        //$totalRecordsProcessos = Processo::all()->count();
        $totalRecordsProcessos = Dashboard::totalProcessosMesAnoEspecifico($mes_especifico, $ano_especifico);

        switch($cat_corrente){
            // Sexo Biolgócigo
            case 1:
                $records = DB::select("SELECT COUNT(id) as quantidade, sexobiologico as labelcategoria FROM processos WHERE YEAR(created_at) = $ano_especifico AND MONTH(created_at) = $mes_especifico GROUP BY sexobiologico ORDER BY COUNT(id) DESC");
            break;
            // Comunidade
            case 2:
                $records = DB::select("SELECT COUNT(id) as quantidade, comunidade as labelcategoria FROM processos WHERE YEAR(created_at) = $ano_especifico AND MONTH(created_at) = $mes_especifico GROUP BY comunidade ORDER BY COUNT(id) DESC");
            break;
            // Cor/raca
            case 3:
                $records = DB::select("SELECT COUNT(id) as quantidade, racacor as labelcategoria FROM processos WHERE YEAR(created_at) = $ano_especifico AND MONTH(created_at) = $mes_especifico GROUP BY racacor ORDER BY COUNT(id) DESC");
            break;
            // Identidade de Gênero
            case 4:
                $records = DB::select("SELECT COUNT(id) as quantidade, identidadegenero as labelcategoria FROM processos WHERE YEAR(created_at) = $ano_especifico AND MONTH(created_at) = $mes_especifico GROUP BY identidadegenero ORDER BY COUNT(id) DESC");
            break;
            // Orientação Sexual
            case 5:
                $records = DB::select("SELECT COUNT(id) as quantidade, orientacaosexual as labelcategoria FROM processos WHERE YEAR(created_at) = $ano_especifico AND MONTH(created_at) = $mes_especifico GROUP BY orientacaosexual ORDER BY COUNT(id) DESC");
            break;
            // Deficiente
            case 6:
                $records = DB::select("SELECT COUNT(id) as quantidade, deficiente as labelcategoria FROM processos WHERE YEAR(created_at) = $ano_especifico AND MONTH(created_at) = $mes_especifico GROUP BY deficiente ORDER BY COUNT(id) DESC");
            break;
            // Estado Civil
            case 7:
                $records = DB::select("SELECT COUNT(id) as quantidade, estadocivil as labelcategoria FROM processos WHERE YEAR(created_at) = $ano_especifico AND MONTH(created_at) = $mes_especifico GROUP BY estadocivil ORDER BY COUNT(id) DESC");
            break;
        }

        // Vê resultado na requisião ajax: dd(count($records));

        if(count($records) > 0){
            foreach($records as $value) {
                $dataRecordsCategorias[Str::upper($value->labelcategoria)] =  $value->quantidade;
            }
        }else{
            $dataRecordsCategorias[''] =  0;
        }

        $data['totalrecords'] = $totalRecordsProcessos;
        $data['dados'] =  $dataRecordsCategorias;

        return response()->json($data);
    }


    // Método utilizado com Biblioteca Spatie-Simple-Excel
    public function gerarexcel(Request $request)
    {

        $mes = $request->mesexcel;
        $ano = $request->anoexcel;
        $tipo = $request->tipoexcelcsv;


        // Testa se todos os parâmetros são válidos
        // if($mes != 0 && $ano != 0 && $tipo != 0){
        if($tipo != 0){

            // Adiciona um 0 (zero) na frente do mês de 01 a 09
            $mes = ($mes < 10) ? "0".$mes : $mes;

            // Define o nome do arquivo(formado por mês e ano ou apenas o ano)
            $referencia = ($mes == "00") ? $ano : $mes."_".$ano;

            // Define o tipo de arquivo a ser gerado
            $tipoextensao = ($tipo == 1) ? 'xlsx' : 'csv';

            // Definindo a query
            if($mes == 0){
                $records = DB::table('processos')->selectRaw('id, nomecompleto')->whereYear('created_at', $ano)->get();
            }else{
                $records = DB::table('processos')->selectRaw('id, nomecompleto')->whereMonth('created_at', $mes)->whereYear('created_at', $ano)->get();
            }

            $writer = SimpleExcelWriter::streamDownload("semualuguelmp_$referencia.$tipoextensao")->addHeader(['Registro', 'Nome']);

            // Contador para esvaziar buffer com flush()
            $countbuffer = 1;

            foreach ($records as $record ) {
                $writer->addRow([
                    'id' => $record->id,
                    'nomecompleto' => $record->nomecompleto,
                ]);

                // Limpa o buffer a cada mil linhas
                $countbuffer++;

                if($countbuffer % 1000 === 0){
                    flush();
                }
            }

            $writer->toBrowser();

        } else {
            return redirect()->route('dashboard.index')->with('error', 'Escolha um tipo de arquivo: Excel ou CSV, para ser gerado!');;
        }


    }    





}
