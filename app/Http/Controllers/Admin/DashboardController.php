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

        ///
        // Meses e anos para popular campos selects. Obs: os índices do array não pode ser: 01, 02, 03, etc... por isso a configuração acima: $mes_corrente = date('n');
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
        
        // Obtendo os todais de entidades do sistema
        $totRegionais               =  Dashboard::totalRegionais();
        $totMunicipios              =  Dashboard::totalMunicipios();
        $totTipounidades            =  Dashboard::totalTipounidades();
        $totUnidades                =  Dashboard::totalUnidades();
        $totTipodocumentos          =  Dashboard::totalTipodocumentos();
        $totRequerentes             =  Dashboard::totalRequerentes();
            $totEstatusAndamento    =  Dashboard::totalRequerentesAndamento();
            $totEstatusAnalise      =  Dashboard::totalRequerentesAnalise();
            $totEstatusPendente     =  Dashboard::totalRequerentesPendente();
            $totEstatusCorrigido    =  Dashboard::totalRequerentesCorrigido();
            $totEstatusConcluido    =  Dashboard::totalRequerentesConcluido();
        $totProcessos               =  Dashboard::totalProcessos();
        $totProcessosMesAnoCorrente =  Dashboard::totalProcessosMesAnoCorrente();     // Total de processos do Mês e Ano correntes
        $totUsuarios                =  Dashboard::totalUsuarios();



        // Recuperando todos os processos para a tabela de PROCESSOS
        // $processos = Processo::orderBy('nomecompleto')->paginate(10);
        $processos =  Dashboard::processos();


        //Dados StatusRequerente para gráfico de Linha padrão, ou seja, logo que a Dashboard é carregada
        $recordsstatusrequerente = ['Andamento' => 0, 'Análise' => 0, 'Pendente' => 0, 'Corrigido' => 0, 'Concluído' => 0];
        
        $recordsSituacoes = DB::select("SELECT COUNT(id) as quantidade, status as situacao FROM requerentes WHERE YEAR(created_at) = $ano_corrente AND MONTH(created_at) = $mes_corrente  GROUP BY status ORDER BY COUNT(id) DESC");
        
        if($recordsSituacoes > 0){
            foreach($recordsSituacoes as $key => $value){
                if($value->situacao == 1){
                    $recordsstatusrequerente['Andamento'] = $value->quantidade;
                }
                if($value->situacao == 2){
                    $recordsstatusrequerente['Análise'] = $value->quantidade;
                }
                if($value->situacao == 3){
                    $recordsstatusrequerente['Pendente'] = $value->quantidade;
                }
                if($value->situacao == 4){
                    $recordsstatusrequerente['Corrigido'] = $value->quantidade;
                }
                if($value->situacao == 5){
                    $recordsstatusrequerente['Concluído'] = $value->quantidade;
                }
            }
        }else{
            $recordsstatusrequerente = ['Andamento' => 0, 'Análise' => 0, 'Pendente' => 0, 'Corrigido' => 0, 'Concluído' => 0];
        }

        //----------Trecho de código referente ao gráfico de colunas
        // 
        // Configurando totais de requerimentos Mês a Mês (Independente de qualquer cirtério de pesquisa, apenas ANO)
        $recordsrequerimentosmesames  = ['1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0];

        //Recuperando todos os requerimentos concluidos (ou seja, tornaram-se processos) independente de regional, município, unidade de atendimento etc...
        $recordsmesames = DB::select("SELECT MONTH(created_at) as mes, COUNT(id) as quantidade FROM processos WHERE YEAR(created_at) = $ano_corrente GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");

        $numregsretorno = count($recordsmesames);

        if($numregsretorno > 0){
            foreach($recordsmesames as $value){
                // Atribui ao mês o respectivo valor referente a quantidade de requerimentos
                $recordsrequerimentosmesames[$value->mes] = $value->quantidade;
            }
        }else{
            // Se nada for retornado, todos os valores (correspondnte aos meses) serão 0 (zero)
            $recordsrequerimentosmesames  = ['1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0];
        }

        //----------Trecho de código referente ao gráfico de colunas


        //Dados SexoBiológico para gráfico de Pizza padrão, ou seja, logo que a Dashboard é carregada
        //$records = DB::select("SELECT COUNT(id) as quantidade, sexobiologico as sexo FROM requerentes WHERE MONTH(created_at) = $mes_corrente  AND YEAR(created_at) = $ano_corrente GROUP BY sexobiologico ORDER BY COUNT(id) DESC");
        $recordsCategorias = DB::select("SELECT COUNT(id) as quantidade, sexobiologico as sexo FROM processos WHERE YEAR(created_at) = $ano_corrente AND MONTH(created_at) = $mes_corrente GROUP BY sexobiologico ORDER BY COUNT(id) DESC");
        

        // Início - Ignite
            // Situacao Requerente
            $dataRecordsSituacoes = [];
            if(count($recordsSituacoes) > 0){
                foreach($recordsSituacoes as $value) {
                    $dataRecordsSituacoes[$value->situacao] =  $value->quantidade;
                }
            }else{
                $dataRecordsSituacoes[''] =  0;
            }
            
            // Categoria Requerente
            $dataRecordsCategorias = [];
            if(count($recordsCategorias) > 0){
                foreach($recordsCategorias as $value) {
                    $dataRecordsCategorias[Str::upper($value->sexo)] =  $value->quantidade;
                }
            }else{
                $dataRecordsCategorias[''] =  0;
            }
        // Fim - Ignite
       
        return view('admin.dashboard.index', compact(
            'categorias',
            'mes_corrente','ano_corrente','mesespesquisa', 'anospesquisa',
            'totRegionais', 'totMunicipios', 'totTipounidades', 'totUnidades', 'totTipodocumentos', 'totUsuarios', 
            'totRequerentes', 'totEstatusAndamento', 'totEstatusAnalise', 'totEstatusPendente', 'totEstatusCorrigido', 'totEstatusConcluido',
            'totProcessos', 'totProcessosMesAnoCorrente',
            'dataRecordsSituacoes', 'recordsstatusrequerente' ,'dataRecordsCategorias', 'recordsrequerimentosmesames',
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
}
