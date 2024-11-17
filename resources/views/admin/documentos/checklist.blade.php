@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">Check List</h2>
        {{--
        <span class="flex-row mt-1 mt-3 mb-1 ms-auto d-sm-flex">
            <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fas fa-upload"></i> Adicionar </a>
        </span>
        --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="gap-2 card-header hstack">

            <span class="p-2 small"><strong> Requerente: {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} </strong></span>
            {{--
            <span class="flex-row mt-1 mb-1 ms-auto d-sm-flex">
                <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index')}}" role="button">Cancelar</a>
                <a class="btn btn-danger me-1" href="{{ route('documento.merge', ['requerente' => $requerente->id]) }}"><i class="fa-solid fa-layer-group"></i> Processar Documentos </a>
            </span>
            --}}
        </div>

        <div class="card-body">

            {{-- @dd($documentos) --}}

            <x-alert />

            {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
            <x-errorexception />
            <form action="{{ route('documento.update', ['requerente' => $requerente->id]) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Documento</th>
                            <th>Visualizar</th>
                            <th style="padding-left: 40px">Aprovado{{-- Confere --}}</th>
                            <th>Observação</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            // Inicializa umm array vazio;
                            $array_ids_documentos = [];
                        @endphp
                        @forelse ($documentos as $documento)
                            @php
                                // Adiciona ao array o valor de cada id dos documentos 
                                $array_ids_documentos[] = $documento->id;
                            @endphp
                            <tr>
                                <td>{{ $documento->id }}</td>
                                <td>{{ $documento->tipodocumento->nome }}</td>
                                <td> 
                                    <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank"> 
                                        <img src="{{ asset('images/documentos2.png') }}" width="30" style="margin-left: 25px;"> 
                                    </a>
                                </td>
                                <td>
                                    <div style="margin-top: 7px">
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input aprovacao" type="radio" name="aprovado_{{ $documento->id }}" id="aprovado_{{ $documento->id }}sim" value="1" {{old("aprovado_$documento->id") == "1" ? "checked" : ""}}>
                                                <label class="form-check-label" for="aprovado_{{ $documento->id }}sim">sim</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input aprovacao" type="radio" name="aprovado_{{ $documento->id }}" id="aprovado_{{ $documento->id }}nao" value="0" {{old("aprovado_$documento->id") == "0" ? "checked" : ""}}>
                                                <label class="form-check-label" for="aprovado_{{ $documento->id }}nao">não</label>
                                            </div>
                                            <br>
                                            @error("aprovado_{{ $documento->id }}")
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{-- observacao --}}
                                    <div class="form-group focused">
                                        <textarea style="visibility:hidden" class="form-control" name="observacao_{{ $documento->id }}" id="observacao_{{ $documento->id }}" rows="2" placeholder="justifique..."></textarea>
                                        @error("observacao_{{ $documento->id}}")
                                            <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum documento encontrado! </div>
                        @endforelse
                        {{-- array_ids_documentos_hidden, recebe o valor do array tranformado em string separado por vírgula --}}
                        <input type="hidden" name="array_ids_documentos_hidden" value="{{ implode(',', $array_ids_documentos) }}">
                    </tbody>
                </table>

                <!-- Buttons -->
                <div class="flex-row col-12 d-md-flex justify-content-end">
                    <div style="margin-top: 25px">
                        {{-- <a class="btn btn-outline-secondary me-2" href="{{ url()->previous() }}" role="button">Cancelar</a> --}}
                        <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index') }}" role="button">Cancelar</a>
                        <button type="submit" class="btn btn-primary me-4" style="width: 95px;"> Anexar </button>

                        {{--
                        Este campo só dever ser mostrado se não houver pendências (aprovado = não)
                        Quando submeter para análise, o campo pendente(status) na tabela requerente deverá ser atualizado para "em análise e nada mais poderá ser feito em relação ao requerente, ou seja, nem cadastrar, nem editar, nem apagar"
                        --}}
                        <a style="visibility:hidden" class="btn btn-danger me-1" href="{{ route('documento.merge', ['requerente' => $requerente->id]) }}"  id="button-mesclar"><i class="fa-solid fa-layer-group"></i> Mesclar </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>

        // Resgata o número de radio button para cada aprovação, no caso, será o valor * 2 pois para cada aprovação existirá dois radios buttons (sim e não)
        var num_aprovacao = $(".aprovacao").length;
        // Define o número de aprovacoes do tipo sim para 0, pois para cada sim, será adicionado uma unidade.
        var num_sim_aprovado = 0;
        var num_nao_aprovado = 0;

        // Para cada radio button cuja classe seja "aprov", execute uma função
        $(".aprovacao").each(function() {
            // Em cada radio button clickado execute uma função
            $(this).on('click', function() {
                // Obtenha o nome da propriedade "name" através da função "attr"
                let nomeElemento = $(this).attr('name');
                // Extraia apenas a parte que contenha o número da propriedade "name", no caso "aprovado_xx" com a função "substring"
                idElemento = nomeElemento.substring(9);

                // Exibindo o campo observação corresponde ao radio button clicado
                if($(this).val() == 0){
                    $("#observacao_" + idElemento).css("visibility","visible");
                    $("#observacao_" + idElemento).focus();
                    $("#observacao_" + idElemento).attr("required");
                    $("#button-mesclar").css("visibility","hidden");
                    // Adiciona uma unidade para cada aprovação do tipo sim
                    num_nao_aprovado = num_nao_aprovado + 1;
                    // Chama a função que irá avaliar se a soma de todos os "sim" é igual à metade do radios button existentes.
                    hiddenButtonMesclar(num_nao_aprovado);
                }else{
                    $("#observacao_" + idElemento).css("visibility","hidden");
                    $("#observacao_" + idElemento).val("");
                    $("#observacao_" + idElemento).removeAttr("required");
                    // Adiciona uma unidade para cada aprovação do tipo sim
                    num_sim_aprovado = num_sim_aprovado + 1;
                    // Chama a função que irá avaliar se a soma de todos os "sim" é igual à metade do radios button existentes.
                    displayButtonMesclar(num_sim_aprovado);
                };
            });
        });

        function displayButtonMesclar(qtd_sim){
            // A comparação é maior ou igual, porquê o usuário pode definir um anexo como aprovado, depois como não aprovado e novamente como aprovado
            // o quê sempre acrescentara mais uma unidade para a variável num_sim_aprovado, podendo esta ultrapassar o valor da quantidade de radios buttons
            // dividido por dois
            if(qtd_sim >= (num_aprovacao / 2)){
                $("#button-mesclar").css("visibility","visible");
            } 
        }


        function hiddenButtonMesclar(qtd_nao){
            // Qualquer  quantidade de num_nao_aprovado, ou seja, maior que 0, irá ocultar o botão de mesclar
            if(qtd_nao > 0 ){
                $("#button-mesclar").css("visibility","hidden");
            }
        }

    </script>

@endsection


