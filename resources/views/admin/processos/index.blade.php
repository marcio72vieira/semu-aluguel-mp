@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">PROCESSOS</h2>
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="gap-2 card-header hstack">
            <span class="flex-row mt-1 mb-1 ms-auto d-sm-flex">
                <label id="ocultarExibirPaineldeFiltragem" style="cursor: pointer; font-size: 17px;"><i id="iconeVisao" class="{{ $flag != '' ? 'fa-solid fa-filter' : 'fas fa-eye-slash' }}" style=" margin-right: 5px;"></i>{{ $flag != '' ? "Filtro" : "Ocultar" }}</label>
            </span>
        </div>

        {{-- inicio painel de filtragem --}}
        <div class="mt-1 mb-4 shadow card border-light" id="formularioFiltragem" style="display: {{ $flag }}">

            <div class="card-body">
                <form action="{{ route('processo.index') }}">
                    <div class="mb-3 row">
                        {{-- Colunas, quando for dispositivos médios(md) ocupe 4 grids e quando for dispositivos pequenos(sm) ocupe 12 grids--}}
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="name">Requerente</label>
                            <input type="text" name="requerente" id="requerente" class="form-control" value="{{ $requerente }}" placeholder="Nome da requerente">
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="role">Regional</label>
                            <input type="text" name="regional" id="regional" class="form-control" value="{{ $regional }}" placeholder="Regional da unidade">
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="municipio">Município</label>
                            <input type="text" name="municipio" id="municipio" class="form-control" value="{{ $municipio }}" placeholder="Município da unidade">
                        </div>

                        <div class="col-md-1 col-sm-12">
                            <label class="form-label" for="role">Tipo</label>
                            <input type="text" name="tipounidade" id="tipounidade" class="form-control" value="{{ $tipounidade }}" placeholder="Tipo unidade">
                        </div>
                        
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="role">Unidade</label>
                            <input type="text" name="unidade" id="unidade" class="form-control" value="{{ $unidade }}" placeholder="Unidade de atendimento">
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="role">Analista</label>
                            <input type="text" name="analista" id="analista" class="form-control" value="{{ $analista }}"  placeholder="Analista">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="data_cadastro_inicio">Data cadastro início</label>
                            <input type="date" name="data_cadastro_inicio" id="data_cadastro_inicio" class="form-control" value="{{ $data_cadastro_inicio }}">
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="data_cadastro_fim">Data cadastro fim</label>
                            <input type="date" name="data_cadastro_fim" id="data_cadastro_fim" class="form-control" value="{{ $data_cadastro_fim }}">
                        </div>

                        <div class="pt-3 col-md-2 col-sm-12">
                            <div style="margin-top:20px;">
                                <button type="submit" name="pesquisar" value="stoped" id="btnpesquisar" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                                <button type="button" class="btn btn-warning btn-sm" id="btnlimpar"><i class="fa-solid fa-trash"></i> Limpar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- fim painel de filtragem--}}


        <div class="card-body">

            <x-alert />

            {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
            <x-errorexception />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Requerente</th>
                        <th>Regional</th>
                        <th>Município</th>
                        <th>Tipo</th>
                        <th>Unidade Atendimento</th>
                        <th>Operador</th>
                        <th>Analista</th>
                        <th>Cadastro</th>
                        <th>Processo</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($processos as $processo)
                        <tr>
                            <td>{{ $processo->id }}</th>
                            <td>{{ $processo->nomecompleto }}</th>
                                <td>{{ $processo->regional }}</td>
                                <td>{{ $processo->municipio }}</td>
                                <td>{{ $processo->tipounidade }}</td>
                                <td>{{ $processo->unidadeatendimento }}</td>
                                <td>{{ $processo->assistente }}</td>
                                <td>{{ $processo->funcionario }}</td>
                                <td>{{ mrc_turn_data($processo->datacadastro) }}</th>
                            <td> <a href="{{ asset('/storage/'.$processo->url) }}" target="_blank" title="Visualizar este documento"> <img src="{{ asset('images/icopdf3.png') }}" width="30" style="margin-left: 25px;"> </a></td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum PROCESSO encontrado!</div>
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
        // Esconde/Exibe painel de filtragem
        $("#ocultarExibirPaineldeFiltragem").click(function(){
            if($(this).text() == "Ocultar"){
                //$(this).text("Exibir");
                $("#ocultarExibirPaineldeFiltragem").html("<i id='iconeVisao' class='fa-solid fa-filter' style='margin-right: 5px;'></i>Filtro");
                limparCampos();
            }else {
                //$(this).text("Ocultar");
                $("#ocultarExibirPaineldeFiltragem").html("<i id='iconeVisao' class='fas fa-eye-slash' style='margin-right: 5px;'></i>Ocultar");
            }

            $("#formularioFiltragem").toggle();
            //$("#iconeVisao", this).toggleClass("fas fa-eye-slash fas fa-eye");
        });

        $("#btnpesquisar").on('click', function(){
            $(this).attr('value', 'started');
        });

        // "Limpa campos de pesquisa"
        $("#btnlimpar").on('click', function(){
            limparCampos();
        })

        function limparCampos(){
            $("#requerente").val("");
            $("#regional").val("");
            $("#municipio").val("");
            $("#unidade").val("");
            $("#estatus").val("");
            $("#tipounidade").val("");
        }
    </script>
@endsection

