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
        $categorias = [
            '1' => 'Sexo Biológico', '2' => 'Comunidade', '2' => 'Cor/Raça', '4' => 'Identidade de Gênero', '5' => 'Orientação Sexual', '6' => 'Deficiente'
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
        ///
        // Obtendo os todais de entidades do sistema
        $totRegionais       =  Dashboard::totalRegionais();
        $totMunicipios      =  Dashboard::totalMunicipios();
        $totTipounidades    =  Dashboard::totalTipounidades();
        $totUnidades        =  Dashboard::totalUnidades();
        $totTipodocumentos  =  Dashboard::totalTipodocumentos();
        $totRequerentes     =  Dashboard::totalRequerentes();
        $totProcessos       =  Dashboard::totalProcessos();
        $totUsuarios        =  Dashboard::totalUsuarios();

        // Recuperando todos os processos para a tabela de PROCESSOS
        // $processos = Processo::orderBy('nomecompleto')->paginate(10);
        $processos =  Dashboard::processos();

        //Dados SexoBiológico para gráfico de Pizza
        //$records = DB::select("SELECT COUNT(id) as quantidade, sexobiologico as sexo FROM requerentes WHERE MONTH(created_at) = $mes_corrente  AND YEAR(created_at) = $ano_corrente GROUP BY sexobiologico ORDER BY COUNT(id) DESC");
        $records = DB::select("SELECT COUNT(id) as quantidade, sexobiologico as sexo FROM requerentes WHERE YEAR(created_at) = $ano_corrente GROUP BY sexobiologico ORDER BY COUNT(id) DESC");


        
        //Ignite
        $dataRecords = [];

        if(count($records) > 0){
            foreach($records as $value) {
                $dataRecords[Str::upper($value->sexo)] =  $value->quantidade;
            }
        }else{
            $dataRecords[''] =  0;
        }

        return view('admin.dashboard.index', compact(
            'categorias',
            'mes_corrente','ano_corrente','mesespesquisa', 'anospesquisa',
            'totRegionais', 'totMunicipios', 'totTipounidades', 'totUnidades', 'totTipodocumentos', 'totUsuarios', 'totRequerentes', 'totProcessos', 
            'dataRecords',
            'processos',
        ));
    }
}
