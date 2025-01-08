@extends('layout.admin')

@section('content')

    <div class="px-4 container-fluid">
        <div class="mb-1 hstack gap-5 justify-content-between">
            {{-- (obs: alterar nome do campo cujo texto do questionario foi alrerado) --}}
            <h2 class="mt-4">Dashboard </h2>

            {{-- inicio formulario baixar arquivo excel csv--}}
            <div class="col-md-4">
                <form action="{{ route('dashboard.gerarexcel') }}"  method="GET" class="form-inline" style="margin-top: 10px;">
                    {{-- <span><strong>&nbsp;&nbsp;Gerar arquivo:</strong> &nbsp;&nbsp;</span> --}}
                    <div class="row">
                        <div class="col-md-2" style="margin-left: 165px;">
                            <select id="selectMesExcel" name="mesexcel"  class="form-control col-form-label-sm" style="margin-left: 5px;">
                                <option value="0">Mês...</option>
                                @foreach($mesespesquisa as $key => $value)
                                    {{-- Obs: Os índices dos mêses são 1, 2, 3 ... 12 (sem zeros à esquerda) que corresponde exatamente aos seus índices, vindo do controller e seus valores são: Janeiro, Fevereiro, Março ... Dezembro, por isso a necessidade usarmos o parâmetro $key --}}
                                    {{-- <option value="{{ $value}}" {{date('n') == $key ? 'selected' : ''}} data-mespesquisa="{{$key}}" class="optionMesPesquisa"> {{ $value }} </option>  OU --}}
                                    <option value="{{ $key }}" {{date('n') == $key ? 'selected' : ''}} class="optionMesPesquisa"> {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select id="selectAnoExcel"  name="anoexcel" class="form-control col-form-label-sm" style="margin-left: 5px;">
                                <option value="0" selected disabled>Ano...</option>
                                @foreach($anospesquisa as $value)
                                    <option value="{{ $value }}" {{date('Y') == $value ? 'selected' : ''}} class="optionAnoPesquisa"> {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select id="selectTipoExcelCsv"  name="tipoexcelcsv" class="form-control" style="margin-left: 5px;">
                                <option value="0" selected>Tipo...</option>
                                <option value="1" class="optionAnoPesquisa"><b>EXCEL</b> </option>
                                <option value="2" class="optionAnoPesquisa"><b>CSV</b> </option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="mb-2 btn btn-success btn-sm form-control col-form-label-sm" style="margin-top: 3px;">
                                <i class="fas fa-download"></i>
                                <b>Gerar arquivo</b>
                            </button>
                        </div>
                        {{--
                        <a class="btn btn-primary btn-success form-control col-form-label-sm" href="{{route('admin.dashboard.gerarexcel')}}" role="button"   title="gerar excel">
                            <i class="far fa-file-excel"></i>
                            <b>Gerar Excel</b>
                        </a>
                        --}}
                    </div>
                </form>
            </div>
            {{--    fim formulario baixar arquivo excel csv--}}
            
        </div>

        <div class="row">
            {{-- Regionais --}}
            <div class="col-xl-1 col-md-6">
                <div class="mb-4 text-white card bg-primary">
                    <div class="card-body"><strong>{{ $totRegionais }} Regionais</strong></div>
                </div>
            </div>

            {{-- Municipios --}}
            <div class="col-xl-1 col-md-6">
                <div class="mb-4 text-white card bg-primary">
                    <div class="card-body"><strong>{{ $totMunicipios }} Municípios</strong></div>
                </div>
            </div>

            {{-- Unidades --}}
            <div class="col-xl-1 col-md-6">
                <div class="mb-4 text-white card bg-primary">
                    <div class="card-body"><strong>{{ $totUnidades }} Unidades</strong></div>
                </div>
            </div>

            {{-- Processos --}}
            <div class="col-xl-1 col-md-6">
                <div class="mb-4 text-white card bg-primary">
                    <div class="card-body"><strong>{{ $totProcessos }} Processos</strong></div>
                </div>
            </div>

            {{-- Usuários --}}
            <div class="col-xl-1 col-md-6">
                <div class="mb-4 text-white card bg-primary">
                    <div class="card-body"><strong>{{ $totUsuarios }} Usuários</strong></div>
                </div>
            </div>

            {{-- Tipos de Unidades --}}
            <div class="col-xl-2 col-md-6">
                <div class="mb-4 text-white card bg-primary">
                    <div class="card-body"><strong>{{ $totMunicipios }} Tipos de Unidades</strong></div>
                </div>
            </div>

            {{-- Tipos de Documentos --}}
            <div class="col-xl-2 col-md-6">
                <div class="mb-4 text-white card bg-primary">
                    <div class="card-body"><strong>{{ $totTipodocumentos }} Tipos de Documentos</strong></div>
                </div>
            </div>


            {{-- Requerentes --}}
            <div class="col-xl-3 col-md-6">
                <div class="mb-4 text-white card bg-primary">
                    <div class="card-body">
                        <strong>{{ $totRequerentes }} Requerimentos</strong>
                        &nbsp;&nbsp;&nbsp;<strong>{{ $totEstatusAndamento }} <i class="fa-solid fa-shoe-prints" title="andamento"></i></strong>
                        &nbsp;&nbsp;&nbsp;<strong>{{ $totEstatusAnalise }} <i class="fa-solid fa-user-check" title="análise"></i></strong>
                        &nbsp;&nbsp;&nbsp;<strong>{{ $totEstatusPendente }} <i class="fa-solid fa-clock-rotate-left" title="pendente"></i></strong>
                        &nbsp;&nbsp;&nbsp;<strong>{{ $totEstatusCorrigido }} <i class="fa-solid fa-check-double" title="corrigidos"></i></strong>
                        &nbsp;&nbsp;&nbsp;<strong>{{ $totEstatusConcluido }} <i class="fa-regular fa-circle-check" title="concluídos"></i></strong>
                    </div>
                </div>
            </div>

        </div>

        {{-- Mensagem de error a ser exibida na geração do arquivo Excel ou CSV --}}
        <x-alert />

        <div class="row">
            <div class="col-xl-8">
                <div class="mb-4 card">
                    <div class="card-header" style="padding-top: 10px; padding-bottom: 20px;">
                        <i class="fa-solid fa-chart-line"></i>
                        Status dos Requerimentos
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myAreaChart" width="100%" height="48"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-4">
                <div class="mb-4 card">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myBarChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-4">
                <div class="mb-4 card">
                    <div class="card-header">
                        {{-- --}}
                        <div id="mesesanoscategoriaparapesquisa" class="col-md-12 d-sm-flex justify-content-between">
                            <span style="margin: 5px;"><i class="fa-solid fa-chart-pie"></i></span>
                            <span id="selecionacategoria" style="margin: 5px;">Categorias:</span>
                            <select id="selectCategoriaPesquisa_id" class="form-control col-form-label-sm selectsgraficopizzarosaca">
                                {{-- Se a "option" Categoria está desabilitada, então ele seleciona o primeiro da lista, no caso "Sexo Biológico", por default --}}
                                <option value="" disabled>Categoria</option>
                                @foreach($categorias as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;
                            {{-- <span id="selecionames" class="text-primary" style="margin: 5px;">Mês:</span> --}}
                            <select id="selectMesPesquisa_id" class="form-control col-form-label-sm selectsgraficopizzarosaca">
                                <option value="" selected disabled>Mês...</option>
                                @foreach($mesespesquisa as $key => $value)
                                    {{-- Obs: Os índices dos mêses são 1, 2, 3 ... 12 (sem zeros à esquerda) que corresponde exatamente aos seus índices, vindo do controller e seus valores são: Janeiro, Fevereiro, Março ... Dezembro, por isso a necessidade usarmos o parâmetro $key --}}
                                    {{-- <option value="{{ $value}}" {{date('n') == $key ? 'selected' : ''}} data-mespesquisa="{{$key}}" class="optionMesPesquisa"> {{ $value }} </option>  OU --}}
                                    <option value="{{ $key }}" {{date('n') == $key ? 'selected' : ''}} data-mespesquisa="{{$key}}" class="optionMesPesquisa"> {{ $value }} </option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;
                            {{-- <span id="selecionaano" class="text-primary" style="margin: 5px;">Ano:</span> --}}
                            <select id="selectAnoPesquisa_id" class="form-control col-form-label-sm selectsgraficopizzarosaca">
                                <option value="" selected disabled>Ano...</option>
                                @foreach($anospesquisa as $value)
                                    <option value="{{ $value }}" {{date('Y') == $value ? 'selected' : ''}} data-anopesquisa="{{$value}}" class="optionAnoPesquisa"> {{ $value }} </option>
                                @endforeach
                            </select>

                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <select id="tipografico" class="form-control col-form-label-sm selectsgraficopizzarosaca">
                                <option value="pie">Pizza</option>
                                <option value="doughnut">Rosca</option>
                            </select>
                        </div>

                        {{-- --}}
                    </div>
                    <div class="card-body">
                        <div id="containerchartpiedoughnut">
                            <canvas id="myPieDoughnutChart" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="mb-4 card">
                    <div class="card-header">
                        <i class="fa-solid fa-chart-column"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myBarChart" width="100%" height="15"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 card">
            <div class="card-header mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <i class="fas fa-table me-1"></i>
                        PROCESSOS
                    </div>
                    <div class="col-md-4">
                        {{-- <form action="{{ route('dashboard.gerarexcel') }}"  method="GET" class="form-inline" style="height: 35px;">
                            
                            <div class="row">
                                <div class="col-md-3" style="margin-left: 150px;">
                                    <select id="selectMesExcel" name="mesexcel"  class="form-control col-form-label-sm">
                                        <option value="0">Mês...</option>
                                        @foreach($mesespesquisa as $key => $value)
                                            <option value="{{ $key }}" {{date('n') == $key ? 'selected' : ''}} class="optionMesPesquisa"> {{ $value }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select id="selectAnoExcel"  name="anoexcel" class="form-control col-form-label-sm">
                                        <option value="0" selected disabled>Ano...</option>
                                        @foreach($anospesquisa as $value)
                                            <option value="{{ $value }}" {{date('Y') == $value ? 'selected' : ''}} class="optionAnoPesquisa"> {{ $value }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select id="selectTipoExcelCsv"  name="tipoexcelcsv" class="form-control ">
                                        <option value="0" selected>Tipo...</option>
                                        <option value="1" class="optionAnoPesquisa"><b>EXCEL</b> </option>
                                        <option value="2" class="optionAnoPesquisa"><b>CSV</b> </option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="mb-2 btn btn-success btn-sm form-control col-form-label-sm" style="margin-top: 3px;">
                                        <i class="fas fa-download"></i>
                                        <b>Baixar</b>
                                    </button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requerente</th>
                            <th>Município</th>
                            <th>Unidade Atendimento</th>
                            <th>Assitente Social</th>
                            <th>Funcionario SEMU</th>
                            <th>Processo</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($processos as $processo)
                            <tr>
                                <td>{{ $processo->id }}</th>
                                <td>{{ $processo->nomecompleto }}</th>
                                <td>{{ $processo->municipio }}</td>
                                <td>{{ $processo->unidadeatendimento }}</td>
                                <td>{{ $processo->assistente }}</td>
                                <td>{{ $processo->funcionario }}</td>
                                <td> <a href="{{ asset('/storage/'.$processo->url) }}" target="_blank" title="Visualizar este documento"> <img src="{{ asset('images/icopdf3.png') }}" width="30" style="margin-left: 25px;"> </a></td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum PROCESSO GERADO!</div>
                        @endforelse
                    </tbody>
                </table>

                {{ $processos->links() }}

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @php
    //CONFIGURANDO OS LABELS PARA O GRÁFICO DE LINHA
    if(count($recordsestatusrequerente)){
        //Recuperando só as chaves do array, que será o label dos registros
        $labelRecordsSituacoes = array_keys($recordsestatusrequerente);

        $arrLabelSituacao = [];

        foreach($labelRecordsSituacoes as $labelRecordSituacao){
            // Substitui caracteres especiais (' " / . ,) em uma string por espaço vazio. Evita erro. Ex: farinha D'agua = faria Dagua
            $arrbusca = ["'","/","."];
            $arrtroca = [""];
            $labelRecordSituacao = str_replace($arrbusca, $arrtroca, $labelRecordSituacao);

            // Faz uma concatenação do tipo: 'labelX', 'labelY', 'labelZ', 'labelW', etc... para compor as Labels do Gráfico de Pizza
            $arrLabelSituacao[] = "'".$labelRecordSituacao."'";
        }
    }


    // CONFIGURANDO OS LABELS PARA O GRÁFICO DE PIZZA OU ROSCA
    /*
    //@dd($dataRecordsCategorias)
    //Configurando os labels para os gráficos de Pizza
     if(count($dataRecordsCategorias)){
        //Recuperando só as chaves do array, que será o label dos registros
        $labelRecords = array_keys($dataRecordsCategorias);

        $arrLabel = [];

        foreach($labelRecords as $labelRecord){
            // Substitui caracteres especiais (' " / . ,) em uma string por espaço vazio. Evita erro. Ex: farinha D'agua = faria Dagua
            $arrbusca = ["'","/","."];
            $arrtroca = [""];
            $labelRecord = str_replace($arrbusca, $arrtroca, $labelRecord);

            // Faz uma concatenação do tipo: 'labelX', 'labelY', 'labelZ', 'labelW', etc... para compor as Labels do Gráfico de Pizza
            $arrLabel[] = "'".$labelRecord."'";
        }
    }

    // Versão resumida do script acima. Exibe também no label do gráfico, seu respectivo valor.
    if(count($dataRecordsCategorias)){
        $arrLabel = [];

        foreach($dataRecordsCategorias as $key => $value){
            // Substitui caracteres especiais (' " / . ,) em uma string por espaço vazio. Evita erro. Ex: farinha D'agua = faria Dagua
            $arrbusca = ["'","/","."];
            $arrtroca = [""];
            $key = str_replace($arrbusca, $arrtroca, $key);

            // Faz uma concatenação do tipo: 'labelX', 'labelY', 'labelZ', 'labelW', etc... para compor as Labels do Gráfico de Pizza
            $arrLabel[] = "'".$value." ".$key."'";
        }
    */

    // Versão resumida do script acima. Exibe também no label do gráfico, seu respectivo valor em %.
    if(count($dataRecordsCategorias)){
        $arrLabel = [];

        foreach($dataRecordsCategorias as $key => $value){

            // Substitui caracteres especiais (' " / . ,) em uma string por espaço vazio. Evita erro. Ex: farinha D'agua = faria Dagua
            $arrbusca = ["'","/","."];
            $arrtroca = [""];
            $key = str_replace($arrbusca, $arrtroca, $key);

            // Calculando a porcentagem de cada label da categoria e evitando o erro de divisão por zero
            $porcentagem = $totProcessosMesAnoCorrente != 0 ? ((100 * $value) / $totProcessosMesAnoCorrente) : 0;
            $porcentagem = number_format($porcentagem, 1, ",", ".");

            // Faz uma concatenação do tipo: 'labelX', 'labelY', 'labelZ', 'labelW', etc... para compor as Labels do Gráfico de Pizza
            // $arrLabel[] = "'".$value." ".$key."'";       // Exibe valores em números
            $arrLabel[] = "'".$porcentagem."% ".$key."'";   // Exibe valores em porcentagem
        }
    }


    //CONFIGURANDO OS LABELS PARA O GRÁFICO DE COLUNA MÊS A MÊS
    //OBS: Não há a necessidade de configurar os Labels, visto que os label são fixos, ou seja, Janeiro, Fevereiro, Março, etc...
    @endphp



    <script>
        //////////////////////////////////////
        //  ÁREA DE DEFINIÇÃO DE VARIÁVEIS  //
        //////////////////////////////////////

        var valmespesquisa = "{{ $mesespesquisa[$mes_corrente] }} ";   // valor padão vindo da view
        var valanopesquisa = "{{ $ano_corrente }}";                    // valor padão vindo da view

        // var titulomesanoatual = "{{ $mesespesquisa[$mes_corrente] }} " + " - " + "{{ $ano_corrente }}"; // Valores vindo da "view" através do "compac()"
        var valcategoria = 0;
        var textcategoria = ""
        var textmes = "";
        var textano = "";
        var estilo = "";                                            // estilo do gráfico de pizza ou rosca quando escolhido
        var titulo =  "SEXO BIOLÓGICO";                             // valor da pesquisa padão definido no carregamento da página
        var subtitulo = valmespesquisa + " - " + valanopesquisa;    // valor da pesquisa padão vindo da no carregamento da pagina


        ///////////////////////////////////////
        //  ÁREA DE DEFINIÇÃO DOS GRÁFICOS   //
        ///////////////////////////////////////

        // Gráfico de Area
        var ctx_area = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx_area, {
            type: 'line',
            data: {
                labels: ["Andamento", "Análise", "Pendente", "Corrigido", "Concluído"],
                datasets: [{
                    label: "status",
                    lineTension: 0.1,
                    backgroundColor: "rgba(54, 162, 235,0.3)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: [ {{ implode(',', $recordsestatusrequerente) }} ],     // Valor vindo diretamente da view, pelo método compact
                    fill: true,
                }],
            },
            plugins: [ChartDataLabels], // Exibe rótulo dos valores dentro dos gráficos..É necessário importar o plugin em: "view.layout.admin.blade.php"
            options: {
                /*
                // Comentar essas propriedades, por algum motivo evita o erro: Invalid scale configuration for scale: xAxes  e yAxes
                scales: {
                    xAxes: [{ time: { unit: 'date' }, gridLines: { display: false }, ticks: { maxTicksLimit: 7 } }],
                    yAxes: [{ ticks: { min: 0, max: 40000, maxTicksLimit: 5 }, gridLines: { color: "rgba(0, 0, 0, .125)", } }],
                },
                */
                scales: {y: {min: 0, max: 20 }},
                legend: {
                    display: false
                },
                plugins: {
                    datalabels: {
                            color: '#0000ff',   // Cor dos valores das colunas
                            anchor: 'end',      // Determina a posição dos valoresa serem exibidos : Default meio(não é necessário informar), end(no final da coluna de baixo para cima)
                            align: 'top',       // posição dos valores (top, left, right, bottom) em relação ao anchor:end
                            offset: 5           // distância em pixel do valores a serem apresentados
                        }
                }
            }
        });


        // Gráfico de Pizza ou Dounougth
        const ctx_piedoughnut = document.getElementById('myPieDoughnutChart');

        const graficopizzarosca = new Chart(ctx_piedoughnut, {
            type: 'pie', // ou doughnut
            data: {
                labels: [ {!! implode(',', $arrLabel) !!} ], //labels: ['1 MASCULINO', '2 FEMININO'],
                datasets: [{
                    label: 'registros',
                    data: [ {{ implode(',', $dataRecordsCategorias) }} ], //Dados vindo da view via método compact. São os valores propriamente ditos, ficando do tipo: [10, 30, 20.50, 70 ..etc]
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: { display: true, position: 'right' },
                    title: { display: true, text: titulo },
                    subtitle: { display: true, text: subtitulo }
                }
            }
        });


        // Gráfico de Barras
        const ctx = document.getElementById('myBarChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'],
                datasets: [{
                label:  '',          // conteúdo original: 'REQUERIMENTOS',
                data: [ {{ implode(',', $recordsprocessosmesames) }} ],
                backgroundColor: "rgb(54, 162, 235)",
                borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels], // Exibe rótulo dos valores dentro dos gráficos..É necessário importar o plugin em: "view.layout.admin.blade.php"
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min:0,
                        max: 20
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: "REQUERIMENTOS",
                        align: 'center',        //Nova configuração (start, center, end)
                        padding: {
                            top: 3,
                            bottom: 3
                        }
                    },
                    subtitle: {
                        display: true,
                        text: valanopesquisa,   // ano corrente
                        align: 'center',        //Nova configuração (start, center, end)
                    },
                    datalabels: {
                            color: '#0000ff',   // Cor dos valores das colunas
                            anchor: 'end',      // Determina a posição dos valoresa serem exibidos : Default meio(não é necessário informar), end(no final da coluna de baixo para cima)
                            align: 'top',       // posição dos valores (top, left, right, bottom) em relação ao anchor:end
                            offset: 5           // distância em pixel do valores a serem apresentados
                    },
                }
            },
        });


        ///////////////////////////////////////
        //  ÁREA DE DEFINIÇÃO DOS SCRIPTS    //
        ///////////////////////////////////////

        // Alterna o estilo do gráfico de Pizza para Rosca
        $(document).ready(function() {
            $("#tipografico").on("change", function(){

                if(graficopizzarosca.config.type == 'pie'){
                    graficopizzarosca.config.type = 'doughnut';
                }else{
                    graficopizzarosca.config.type = 'pie';
                }

                graficopizzarosca.update();
            });
        });


        //Escolha de outro tipo de categoria além do tipo padrão: "Sexo Biológico" ou escolha do mẽs, ano ou tipo de gráfico
        //$("#selectCategoriaPesquisa_id").on("change", function(){
        $(".selectsgraficopizzarosaca").on("change", function(){

            //Capturando o valor do mês, ano e da categoria de pesquisa para enviar para a requisição ajax
            valcategoria = $("#selectCategoriaPesquisa_id").val();
            valmespesquisa = $("#selectMesPesquisa_id").val();
            valanopesquisa = $("#selectAnoPesquisa_id").val();

            //Capturando o texto do mês, ano e da categoria de pesquisa para compor o título e o subtitulo do gráfico
            textcategoria = $("#selectCategoriaPesquisa_id").find('option:selected').text().toUpperCase();
            textmes = $("#selectMesPesquisa_id").find('option:selected').text();
            textano = $("#selectAnoPesquisa_id").find('option:selected').text();

            // Capturando o tipo de gráfico desejado (pizza ou rosca)
            estilografico = $("#tipografico").val();

            // Definindo o título e o subtitulo do gráfico
            titulo = textcategoria;
            subtitulo = textmes + " - " + textano;


            // var urltipo = "";

            //Faz requisição para obter novos dados
            $.ajax({
                url:"{{ route('dashboard.index.ajaxgetcategoriachartpie') }}",    //urltipo
                type: "GET",
                data: {
                    categoria: valcategoria,
                    mescorrente: valmespesquisa,
                    anocorrente: valanopesquisa,
                },
                dataType : 'json',

                //Obs:  "result", recebe o valor retornado pela requisição Ajax (result = $data), logo, como resultado, temos:
                //      result['titulo'] que é uma string e result['dados'] que é um array
                success: function(result){

                    var totalregistros = result['totalrecords'];
                    var percent = 0;
                    // Definindo os array que conterão os novos valores de label e data a cada nova pesquisa.
                    // OBS: São definidos aqui e não na área de definição de variáveis, para que não acumulem os valores anteriores,
                    //      como foi observado em teste.
                    var arr_rotuloscategoria = [];
                    var arr_valorescategoria = [];
                    var arr_cores = [];


                    //Iterando sobre o array['dados'] e // Obtém o valor da soma de todas as compras realizadas, para cálculo da %
                    $.each(result['dados'], function(key,value){

                        percent = ((100 * value) / totalregistros);

                        //arr_rotuloscategoria.push(value + " " + key);                                // Exibe valores em números
                        arr_rotuloscategoria.push(number_formatJS(percent,1,",",".") + "% " + key);    // Exibe valores em porcentagem

                        arr_valorescategoria.push(value);
                    });

                    arr_cores = [ 'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(51, 255, 51)', 'rgb(252, 255, 51)', 'rgb(247, 10, 226)', 'rgb(252, 195, 3)', 'rgb(139, 3, 252)' ];

                    //Limpa a área do grafico de pizza ou rosca para evitar sobreposição de informações
                    $('#myPieDoughnutChart').remove();
                    $('#containerchartpiedoughnut').append('<canvas id="myPieDoughnutChart" width="100%" height="50"></canvas>');

                    /// novo grafico
                    // Gráfico de Pizza ou Dounougth
                    const ctx_piedoughnut = document.getElementById('myPieDoughnutChart');
                    const graficopizzarosca = new Chart(ctx_piedoughnut, {
                        type: estilografico,
                        data: {
                            labels: arr_rotuloscategoria,
                            datasets: [{
                                label: 'registros',
                                data: arr_valorescategoria,
                                backgroundColor: arr_cores,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            plugins: {
                                legend: { display: true, position: 'right' },
                                title: { display: true, text: titulo },
                                subtitle: { display: true, text: subtitulo }
                            }
                        }
                    });
                    // fim novo grafico

                    // Atualiza o gráfico de pizza/doughnut de acoro com as opções(selects) escolhidas
                    // graficopizzarosca.data.labels = arr_rotuloscategoria;
                    // graficopizzarosca.data.backgroundColor = arr_cores;
                    // graficopizzarosca.data.datasets.data = arr_valorescategoria;
                    // graficopizzarosca.options.plugins.title.text = titulo;
                    // graficopizzarosca.options.plugins.subtitle.text = subtitulo;
                    // graficopizzarosca.update();
                },
                error: function(result){
                    alert("Error ao retornar dados!");
                }
            });

        });

        //******************************
        // FUNÇÃO PARA FORMATAR NÚMEROS
        //******************************
        function number_formatJS(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }


    </script>
@endsection


