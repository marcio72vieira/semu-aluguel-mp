@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">CHECK LIST - REQUERENTES</h2>
        {{-- <ol class="mt-3 mb-3 breadcrumb ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Requerentes</a></li>
        </ol> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="gap-2 card-header hstack">
            <span class="flex-row mt-1 mb-1 ms-auto d-sm-flex">
                <label id="ocultarExibirPaineldeFiltragem" style="cursor: pointer; font-size: 17px;"><i id="iconeVisao" class="fa-solid fa-filter" style=" margin-right: 5px;"></i>Filtro</label>
                {{-- <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-solid fa-eye-slash"></i> Filtrar </a> --}}
                {{-- <a href="{{ route('user.pdflistusers') }}" class="btn btn-danger btn-sm me-1" target="_blank"><i class="fa-solid fa-file-pdf"></i> pdf</a> --}}
            </span>
        </div>

        {{-- inicio filtro --}}
        <div class="mt-1 mb-4 shadow card border-light" id="formularioFiltragem" style="display: {{ $exibirfiltro == 'sim' ? '' : 'none' }}">
            {{-- <div class="gap-2 card-header hstack"> <span>Filtro</span> </div> --}}

            <div class="card-body">
                <form action="{{ route('checklist.index') }}">
                    <div class="row">
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
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="role">Unidade</label>
                            <input type="text" name="unidade" id="unidade" class="form-control" value="{{ $unidade }}" placeholder="Unidade de atendimento">
                        </div>

                        <div class="col-md-1 col-sm-12">
                            <label class="form-label" for="role">Tipo</label>
                            <input type="text" name="tipounidade" id="tipounidade" class="form-control" value="{{ $tipounidade }}" placeholder="Tipo unidade">
                        </div>

                        <div class="col-md-1 col-sm-12">
                            <div class="form-group focused">
                                <label class="form-label" for="role">Estatus</label>
                                <select name="estatus" id="estatus" class="form-control">
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{ $estatus == '1' ? 'selected' : '' }}>em andamento</option>
                                    <option value="2" {{ $estatus == '2' ? 'selected' : '' }}>para análise</option>
                                    <option value="3" {{ $estatus == '3' ? 'selected' : '' }}>pendente</option>
                                    <option value="4" {{ $estatus == '4' ? 'selected' : '' }}>corrigido</option>
                                    <option value="5" {{ $estatus == '5' ? 'selected' : '' }}>concluído</option>
                                </select>
                            </div>
                        </div>


                        {{-- <div class="col-md-2 col-sm-12">
                            <label class="form-label" for="role">Analista</label>
                            <input type="text" name="analista" id="analista" class="form-control" value="" placeholder="Analista">
                        </div> --}}

                        <div class="pt-3 col-md-2 col-sm-12">
                            <div style="margin-left: 37%; margin-top:20px;">
                                <button type="submit" name="pesquisar" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                                <button type="button" class="btn btn-warning btn-sm" id="btnlimpar"><i class="fa-solid fa-trash"></i> Limpar</button>
                            </div>
                        </div>
                    </div>

                    {{--
                    <div class="mb-3 row">
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="data_cadastro_inicio">Data cadastro início</label>
                            <input type="datetime-local" name="data_cadastro_inicio" id="data_cadastro_inicio" class="form-control" value="">
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="data_cadastro_fim">Data cadastro fim</label>
                            <input type="datetime-local" name="data_cadastro_fim" id="data_cadastro_fim" class="form-control" value="">
                        </div>

                        <div class="pt-3 mt-3 col-md-4 col-sm-12">
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                            <a href="{{ route('user.index')}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-trash"></i> Limpar</a>
                        </div>
                    </div>
                    --}}

                </form>
            </div>
        </div>
        {{-- fim filtro--}}

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
                        <th>Operador {{-- Cadastrado por --}}</th>
                        <th>Telefones</th>
                        <th>Analista {{-- Analisado por --}}</th>
                        <th>Status</th>
                        <th width="200px">Ação</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Acessando propriedades diretamente sem foreach--}}
                    {{-- @dd("Acessando a collection requerentes", $requerentes[0]) --}}
                    {{-- @dd("Acessando a propriedade nomecompleto de requerentes", $requerentes[0]['nomecompleto']) --}}
                    {{-- @dd("Acessando um relacionamento de requerentes", $requerentes[0]['documentos']) --}}
                    {{-- @dd("Acessando uma propriedade de um dos relacionamento de requerentes", $requerentes[0]['documentos'][0]['url']) --}}
                    {{-- @dd("Acessando uma propriedade de um dos relacionamento de requerentes", $requerentes[0]['documentos'][0]['user_id']) --}}
                    {{-- @dd("Acessando a propriedade "nome" do relacionamento regional de requernete", $requerentes[0]['regional']['nome']) --}}



                    @forelse ($requerentes as $requerente)
                        <tr>
                            <td>{{ $requerente->id }}</td>
                            <td>{{ $requerente->nomecompletorequerente }}</td>
                            <td>{{ $requerente->nomeregional }}</td>
                            <td>{{ $requerente->nomemunicipio }}</td>
                            <td>{{ $requerente->nometipounidade }}</td>
                            <td>{{ $requerente->nomeunidade }}</td>
                            <td>{{ $requerente->nomeoperador }}</td>
                            <td>{{ $requerente->foneresidencial }} <br> {{ $requerente->fonecelular }}</td>

                            {{--
                            <td>{{ $requerente->id }}</td>
                            <td>{{ $requerente->nomecompleto }}</td>
                            <td>{{ $requerente->municipio->nome }}</td>
                            <td>{{ $requerente->tipounidade->nome }}</td>
                            <td>{{ $requerente->unidadeatendimento->nome }}</td>
                            <td>{{ $requerente->user->nome }}</td>
                            <td>{{ $requerente->foneresidencial }} <br> {{ $requerente->fonecelular }} </td>
                            --}}

                            <td>
                                {{-- $requerente->servidorResponsavelPelaAnaliseDocumentos(3)[0]->nomecompleto --}}
                                {{-- @foreach ($requerente->documentos as $documento) {{ $documento->user->nomecompleto }} @if ($loop->first) @break @endif @endforeach --}}

                                {{-- @foreach ($requerente->documentos as $documento) --}}

                                    {{--
                                        No momento do cadastro dos documentos o usuário(user_id) que será cadastrado na tabela "documentos", é o usuário(user_id)
                                        do Assistente Social(Operador), responsável pelo cadastro  da Requerente. Só quando  for feita a análise  dos documentos  é  que  o
                                        (user_id) do Servidor da Semu(Analista) irá  substituir o (user_id) do Assistente Social na tabela "documentos". Enquanto a análise
                                        não for concluída, irá aparecer  as "reticẽncias", indicando que os documentos  da Requerente ainda não foram analisados.
                                        Seria um erro exibir o nome do Assistente Social(operador) como sendo o Nome do Servidor da SEMU(analista).
                                        Observação importante:
                                        Nos testes, quando o Administrador cadastrar uma requerente e realizar a análise dos documentos, seu nome não irá aparecer como
                                        sendo o analista(coluna: "analisado por"), isto faz todo sentido, levando em consideração a condição abaixo, ou seja, se o nome  de
                                        quem cadastrou a requerente é o mesmo nome de quem analisou os documentos deverá aparecer as reticências ... na coluna "analisado por"
                                        Esta lógica será aplicada se Uma servidora da SEMU assumir o papel de Operadora e Analista do mesmo Requerente.
                                    --}}
                                    {{--
                                    @if ($documento->user->nome == $requerente->user->nome)
                                        <i class="fa-solid fa-ellipsis" title="documentos sendo anexados..."></i>
                                    @else
                                        {{ $documento->user->nome }}
                                    @endif
                                    @if ($loop->first) @break @endif
                                @endforeach
                                --}}
                                @if($requerente->idOperador == $requerente->idAnalista)
                                    <i class="fa-solid fa-ellipsis" title="documentos sendo anexados..."></i>
                                @else
                                    {{-- Recupera o nome do Analista pelo seu ID através do helper ---}}
                                    {{ mrc_search_analista($requerente->idAnalista) }}
                                    {{-- OU invocando um método stático diretamente: {{ App\Models\User::nomeUserAnalista($requerente->idAnalista) }} --}}
                                @endif
                            </td>
                            <td>
                                @if($requerente->estatus == 1) <span style="font-size: 14px;"> <i class="fa-solid fa-shoe-prints"></i> em andamento </span> @endif  {{-- falta anexar todos os documentos --}}
                                @if($requerente->estatus == 2) <span style="font-size: 14px;"> <i class="fa-solid fa-user-check"></i> para análise  </span> @endif    {{-- os documentos foram enviados para análise depois de anexar os documentos --}}
                                @if($requerente->estatus == 3) <span style="font-size: 14px;"> <i class="fa-solid fa-clock-rotate-left"></i> pendente  </span> @endif {{-- falta anexar documents --}}
                                @if($requerente->estatus == 4) <span style="font-size: 14px;"> <i class="fa-solid fa-check-double"></i> corrigido  </span> @endif {{-- Os documentos inconsistentes foram substituidos --}}
                                @if($requerente->estatus == 5) <span style="font-size: 14px;"> <i class="fa-regular fa-circle-check"></i> concluído  </span> @endif {{-- O check list foi feito e o processo foi gerado --}}
                            </td>
                            <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch">
                                @if($requerente->estatus != 1 && $requerente->estatus != 3 && $requerente->estatus != 5)
                                    <a href="{{ route('documento.index', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-warning btn-sm me-1">
                                        <i class="fa-solid fa-list-check"></i> Analisar documentos
                                    </a>
                                @else
                                    <button type="button"  class="mb-3 btn btn-outline-secondary btn-sm me-1"> <i class="fa-solid fa-ban"></i> Analisar documentos </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhuma Requerente a ser analisada foi encontrada!</div>
                    @endforelse
                </tbody>
            </table>

            {{ $requerentes->links() }}


        </div>

    </div>

</div>


@endsection

@section('scripts')
    <script>
        // Esconde/Exibe os cards para ampliar área de visualização
        $("#ocultarExibirPaineldeFiltragem").click(function(){
            if($(this).text() == "Ocultar"){
                //$(this).text("Exibir");
                $("#ocultarExibirPaineldeFiltragem").html("<i id='iconeVisao' class='fa-solid fa-filter' style='margin-right: 5px;'></i>Filtro");
            }else {
                //$(this).text("Ocultar");
                $("#ocultarExibirPaineldeFiltragem").html("<i id='iconeVisao' class='fas fa-eye-slash' style='margin-right: 5px;'></i>Ocultar");
            }

            $("#formularioFiltragem").toggle();
            //$("#iconeVisao", this).toggleClass("fas fa-eye-slash fas fa-eye");
        });

        // "Limpa campos de pesquisa"
        $("#btnlimpar").on('click', function(){
            $("#requerente").val("");
            $("#regional").val("");
            $("#municipio").val("");
            $("#unidade").val("");
            $("#estatus").val("");
            $("#tipounidade").val("");
        })
    </script>
@endsection


