@extends('layout.admin')

@section('content')
    
    <div class="px-4 container-fluid">
        <h2 class="mt-4">Dashboard</h2>

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
                        <strong>{{ $totRequerentes }} Requerentes</strong>
                        &nbsp;&nbsp;&nbsp;<strong>100 <i class="fa-solid fa-shoe-prints" title="andamento"></i></strong>
                        &nbsp;&nbsp;&nbsp;<strong>100 <i class="fa-solid fa-user-check" title="análise"></i></strong>
                        &nbsp;&nbsp;&nbsp;<strong>100 <i class="fa-solid fa-clock-rotate-left" title="pendente"></i></strong>
                        &nbsp;&nbsp;&nbsp;<strong>100 <i class="fa-solid fa-check-double" title="corrigidos"></i></strong>
                        &nbsp;&nbsp;&nbsp;<strong>100 <i class="fa-regular fa-circle-check" title="concluídos"></i></strong>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-8">
                <div class="mb-4 card">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myAreaChart" width="100%" height="50"></canvas>
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
                            <span id="selecionames" class="text-primary" style="margin: 5px;">Mês:</span>
                            <select id="selectMesPesquisa_id" class="form-control col-form-label-sm selectsgraficopizzarosaca">
                                <option value="" selected disabled>Mês...</option>
                                @foreach($mesespesquisa as $key => $value)
                                    {{-- Obs: Os índices dos mêses são 1, 2, 3 ... 12 (sem zeros à esquerda) que corresponde exatamente aos seus índices, vindo do controller e seus valores são: Janeiro, Fevereiro, Março ... Dezembro, por isso a necessidade usarmos o parâmetro $key --}}
                                    {{-- <option value="{{ $value}}" {{date('n') == $key ? 'selected' : ''}} data-mespesquisa="{{$key}}" class="optionMesPesquisa"> {{ $value }} </option>  OU --}}
                                    <option value="{{ $key }}" {{date('n') == $key ? 'selected' : ''}} data-mespesquisa="{{$key}}" class="optionMesPesquisa"> {{ $value }} </option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;
                            <span id="selecionaano" class="text-primary" style="margin: 5px;">Ano:</span>
                            <select id="selectAnoPesquisa_id" class="form-control col-form-label-sm selectsgraficopizzarosaca">
                                <option value="" selected disabled>Ano...</option>
                                @foreach($anospesquisa as $value)
                                    <option value="{{ $value }}" {{date('Y') == $value ? 'selected' : ''}} data-anopesquisa="{{$value}}" class="optionAnoPesquisa"> {{ $value }} </option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;
                            <span id="selecionacategoria" class="text-primary" style="margin: 5px;">Categoria:</span>
                            <select id="selectCategoriaPesquisa_id" class="form-control col-form-label-sm selectsgraficopizzarosaca">
                                {{-- Se a "option" Categoria está desabilitada, então ele seleciona o primeiro da lista, no caso "Sexo Biológico", por default --}}
                                <option value="" disabled>Categoria</option>
                                @foreach($categorias as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
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
                        <i class="fas fa-chart-bar me-1"></i>
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
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                PROCESSOS
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
    /*
    //@dd($dataRecords)
    //Configurando os labels para os gráficos
     if(count($dataRecords)){
        //Recuperando só as chaves do array, que será o label dos registros
        $labelRecords = array_keys($dataRecords);
        
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
    if(count($dataRecords)){
        $arrLabel = [];
        
        foreach($dataRecords as $key => $value){
            // Substitui caracteres especiais (' " / . ,) em uma string por espaço vazio. Evita erro. Ex: farinha D'agua = faria Dagua
            $arrbusca = ["'","/","."];
            $arrtroca = [""];
            $key = str_replace($arrbusca, $arrtroca, $key);

            // Faz uma concatenação do tipo: 'labelX', 'labelY', 'labelZ', 'labelW', etc... para compor as Labels do Gráfico de Pizza
            $arrLabel[] = "'".$value." ".$key."'";            
        }
    */

    // Versão resumida do script acima. Exibe também no label do gráfico, seu respectivo valor em %.
    $totalrecords = $totProcessos;

    if(count($dataRecords)){
        $arrLabel = [];
        
        foreach($dataRecords as $key => $value){

            // Substitui caracteres especiais (' " / . ,) em uma string por espaço vazio. Evita erro. Ex: farinha D'agua = faria Dagua
            $arrbusca = ["'","/","."];
            $arrtroca = [""];
            $key = str_replace($arrbusca, $arrtroca, $key);

            // Calculando a porcentagem de cada label da categoria
            $porcentagem = ((100 * $value) / $totalrecords);
            $porcentagem = number_format($porcentagem, 1, ",", ".");

            // Faz uma concatenação do tipo: 'labelX', 'labelY', 'labelZ', 'labelW', etc... para compor as Labels do Gráfico de Pizza
            // $arrLabel[] = "'".$value." ".$key."'";       // Exibe valores em números
            $arrLabel[] = "'".$porcentagem."% ".$key."'";   // Exibe valores em porcentagem
        }
    }
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
                    label: "STATUS REQUERENTES",
                    lineTension: 0.1,
                    backgroundColor: "rgba(247,10,226,0.4)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: [25, 10, 30, 30, 20],
                    fill: false,
                }],
            },
            options: {
                /* 
                // Comentar essas propriedades, por algum motivo evita o erro: Invalid scale configuration for scale: xAxes  e yAxes
                scales: {
                    xAxes: [{ time: { unit: 'date' }, gridLines: { display: false }, ticks: { maxTicksLimit: 7 } }],
                    yAxes: [{ ticks: { min: 0, max: 40000, maxTicksLimit: 5 }, gridLines: { color: "rgba(0, 0, 0, .125)", } }],
                }, 
                */
                legend: {
                    display: false
                },
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
                    data: [ {{ implode(',', $dataRecords) }} ], //Dados vindo da view via método compact. São os valores propriamente ditos, ficando do tipo: [10, 30, 20.50, 70 ..etc]
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
                labels: ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'Ojunho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'],
                datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3, 8, 11, 9, 2, 5, 1],
                backgroundColor: "rgb(181,66,162)",
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
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


