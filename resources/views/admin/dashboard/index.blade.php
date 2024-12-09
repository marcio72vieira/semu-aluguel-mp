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
                            <select id="selectMesPesquisa_id" class="form-control col-form-label-sm selectsmesesanoscategoriaspesquisa">
                                <option value="" selected disabled>Mês...</option>
                                @foreach($mesespesquisa as $key => $value)
                                    {{-- Obs: Os índices dos mêses são 1, 2, 3 ... 12 (sem zeros à esquerda) que corresponde exatamente aos seus índices, vindo do controller e seus valores são: Janeiro, Fevereiro, Março ... Dezembro, por isso a necessidade usarmos o parâmetro $key --}}
                                    {{-- <option value="{{ $value}}" {{date('n') == $key ? 'selected' : ''}} data-mespesquisa="{{$key}}" class="optionMesPesquisa"> {{ $value }} </option>  OU --}}
                                    <option value="{{ $key }}" {{date('n') == $key ? 'selected' : ''}} data-mespesquisa="{{$key}}" class="optionMesPesquisa"> {{ $value }} </option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;
                            <span id="selecionaano" class="text-primary" style="margin: 5px;">Ano:</span>
                            <select id="selectAnoPesquisa_id" class="form-control col-form-label-sm selectsmesesanoscategoriaspesquisa">
                                <option value="" selected disabled>Ano...</option>
                                @foreach($anospesquisa as $value)
                                    <option value="{{ $value }}" {{date('Y') == $value ? 'selected' : ''}} data-anopesquisa="{{$value}}" class="optionAnoPesquisa"> {{ $value }} </option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;
                            <span id="selecionacategoria" class="text-primary" style="margin: 5px;">Categoria:</span>
                            <select id="selectCategoriaPesquisa_id" class="form-control col-form-label-sm selectsmesesanoscategoriaspesquisa">
                                <option value="">Categoria</option>
                                @foreach($categorias as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;
                        </div>
    
                        {{-- --}}
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myPieDoughnutChart" width="100%" height="50"></canvas>
                        </div>
                    </div>
                    {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
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
    <script>

        // Gráfico de Area
        var ctx_area = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx_area, {
            type: 'line',
            data: {
                labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
                datasets: [{
                    label: "Sessions",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
                    fill: true,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                        unit: 'date'
                        },
                        gridLines: {
                        display: false
                        },
                        ticks: {
                        maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                        min: 0,
                        max: 40000,
                        maxTicksLimit: 5
                        },
                        gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                },
            }
        });


        // Gráfico de Pizza ou Dounougth
        const ctx_piedoughnut = document.getElementById('myPieDoughnutChart');
        
        new Chart(ctx_piedoughnut, {
            type: 'doughnut', // ou pie
            data: {
                labels: [
                    'Branco',
                    'Preto',
                    'Pardo'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'right'
                    },
                    title: {
                        display: true,
                        text: 'SEXO BIOLÓGICO'
                    },
                    subtitle: {
                        display: true,
                        text: 'Dezembro - 2024'
                    }
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
                backgroundColor: "rgb(2,117,216)",
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

        
    </script>
@endsection


