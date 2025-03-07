@extends('layout.admin')

{{-- RENOMEAR ESTA VIEW checklist.blade.php PARA analise.blade.php --}}

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">CHECK LIST - ANÁLISE</h2>
        {{--
        <span class="flex-row mt-1 mt-3 mb-1 ms-auto d-sm-flex">
            <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fas fa-upload"></i> Adicionar </a>
        </span>
        --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="gap-2 card-header hstack">

            <span class="p-2 small"><strong>ASSISTENTE SOCIAL RESPONSÁVEL: {{ $requerente->user->nomecompleto }} / {{ $requerente->unidadeatendimento->nome }} - {{ $requerente->unidadeatendimento->municipio->nome }}<br> REQUERENTE: {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} </strong></span>
            {{--
            <span class="flex-row mt-1 mb-1 ms-auto d-sm-flex">
                <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index')}}" role="button">Cancelar</a>
                <a class="btn btn-danger me-1" href="{{ route('documento.merge', ['requerente' => $requerente->id]) }}"><i class="fa-solid fa-layer-group"></i> Processar Documentos </a>
            </span>
            --}}
        </div>

        <div class="card-body">

            {{-- @dd($documentos) --}}

            {{-- <x-alert /> --}}

            {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
            {{-- <x-errorexception /> --}}


            <form id="formchecklist" action="{{ route('documento.efetuaanalisegeraprocesso', ["requerente" => $requerente->id]) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            {{-- <th><label style="color:darkgrey">Excluir</label></th> Aqui o analista fica responsável pela exclusão do documento errado --}}
                            <th>Documento</th>
                            <th>Visualizar</th>
                            <th style="padding-left: 40px">Aprovado</th>
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
                                {{--  Aqui o analista fica responsável pela exclusão do documento errado
                                <td>

                                        EXCLUIR DOCUMENTO EM CASO EXTREMO (documento duplicado, documento não exigido e submetido para análise ou por qualquer outro motivo que se deva excluir o arquivo)
                                        Obs: Depois de submetidos os documentos, não tem como serem excluidos ou anexados novos documentos.
                                        Só no caso da alteração do "estatus" do "requerente" para o "estatus 1(em andamento)" é que poder-se-a anexar e excluir documentos)

                                    <form id="formDelete{{ $documento->id }}" method="POST" action="{{ route('documento.destroyinconsistente', ['documento' => $documento->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-secondary btn-sm btnDelete" data-delete-entidade="Documento" data-delete-id="{{ $documento->id }}"  data-value-record="{{ $documento->tipodocumento->nome }}"  title="CERTIFIQUE-SE de excluir este documento apenas em CASOS EXTREMOS!">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                                --}}
                                <td>{{ $documento->tipodocumento->nome }}</td>
                                <td>
                                    @if ($documento->corrigido != 1)
                                        <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank">
                                            <img src="{{ asset('images/documentos2.png') }}" width="30" style="margin-left: 20px;">
                                        </a>
                                    @else
                                        <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank">
                                            <img src="{{ asset('images/left_right.png') }}" width="30" style="margin-left: 20px;">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{-- aprovado --}}
                                    <div style="margin-top: 7px">
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input aprovacao" type="radio" name="aprovado_{{ $documento->id }}" id="aprovado_{{ $documento->id }}sim" value="1" {{old("aprovado_$documento->id", $documento->aprovado) == "1" ? "checked" : ""}}>
                                                <label class="form-check-label" for="aprovado_{{ $documento->id }}sim">sim</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input aprovacao" type="radio" name="aprovado_{{ $documento->id }}" id="aprovado_{{ $documento->id }}nao" value="0" {{old("aprovado_$documento->id", $documento->aprovado) == "0" ? "checked" : ""}}>
                                                <label class="form-check-label" for="aprovado_{{ $documento->id }}nao">não</label>
                                            </div>
                                            <p>
                                                @error("aprovado_$documento->id")
                                                    <small style="color: red" id="msg_erro_apr_{{ $documento->id }}">{{ $message }}</small>
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{-- observacao --}}
                                    <div class="form-group focused">
                                        <textarea style="visibility:hidden" class="form-control observado" name="observacao_{{ $documento->id }}" id="observacao_{{ $documento->id }}" rows="2" placeholder="justifique...">{{ old("observacao_$documento->id", $documento->observacao) }}</textarea>
                                        <p>
                                            @error("observacao_$documento->id")
                                                <small style="color: red" id="msg_erro_obs_{{ $documento->id }}">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum documento encontrado! </div>
                        @endforelse

                        {{-- array_ids_documentos_hidden, recebe o valor do array tranformado em string separado por vírgula --}}
                        <input type="hidden" name="array_ids_documentos_hidden" value="{{ implode(',', $array_ids_documentos) }}">

                        {{-- id do requerente a qual pertence os documentos --}}
                        <input type="hidden" name="requerente_id_hidden" value="{{ $requerente->id }}">

                    </tbody>
                </table>

                <!-- Buttons -->
                <div class="flex-row col-12 d-md-flex justify-content-end">
                    <div style="margin-top: 25px">
                        {{-- <a class="btn btn-outline-secondary me-2" href="{{ url()->previous() }}" role="button">Cancelar</a> --}}
                        <a class="btn btn-outline-secondary me-2" href="{{ route('checklist.index') }}" role="button" style="width: 160px;">Cancelar</a>

                        <button type="submit" class="btn btn-primary me-4" id="analise-processo" style="width: 180px;"><i class='fa-solid fa-arrow-rotate-left'></i> Notificar Análise </button>

                        {{--
                        Este botão só dever ser exibido se todos os documentos forem aprovados, ou seja, não houver pendências (aprovado = não)
                        Quando submeter para análise, o campo pendente(status) na tabela requerente deverá ser atualizado para "em análise e nada mais poderá ser feito em relação ao requerente, ou seja, nem cadastrar, nem editar, nem apagar"
                        se o requerente não passar na análise, os botẽos de editar, visualizr docuemntos poderão ser habilitados novamente.
                        --}}
                        {{--
                        <a style="visibility:hidden" class="btn btn-danger me-1" href="{{ route('documento.merge', ['requerente' => $requerente->id]) }}"  id="button-mesclar"><i class="fa-solid fa-layer-group"></i> Mesclar </a>
                        --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>

        // Para cada radio button cuja classe seja "aprov", execute uma função
        $(".aprovacao").each(function() {
            // Em cada radio button clickado execute uma função
            $(this).on('click', function() {
                // Obtenha o nome da propriedade "name" através da função "attr"
                let nomeElemento = $(this).attr('name');
                // Extraia apenas a parte que contenha o número da propriedade "name", no caso "aprovado_xx" com a função "substring"
                let idElemento = nomeElemento.substring(9);

                // Exibindo o campo observação corresponde ao radio button clicado
                if($(this).val() == 0){
                    $("#observacao_" + idElemento).css("visibility","visible");
                    $("#observacao_" + idElemento).focus();
                    $("#observacao_" + idElemento).attr("required");
                    $("#button-mesclar").css("visibility","hidden");
                    $("#msg_erro_apr_" + idElemento).css("visibility","hidden");
                }else{
                    $("#observacao_" + idElemento).css("visibility","hidden");
                    $("#observacao_" + idElemento).val("");
                    $("#observacao_" + idElemento).removeAttr("required");

                    $("#msg_erro_apr_" + idElemento).css("visibility","hidden");
                    $("#msg_erro_obs_" + idElemento).css("visibility","hidden");
                };

                exibeBotaoAnalise();
            });

        });


        $(".observado").each(function() {
            let nomeElemento = $(this).attr('name');
            let idElemento = nomeElemento.substring(11);
            let elemento = $("#observacao_" + idElemento);

            // $('input:radio[name=sex]:checked').val();
            if($("input:radio[name=aprovado_" + idElemento +"]:checked").val() == 0){
                $("#observacao_" + idElemento).css("visibility","visible");
            }
        });


        function exibeBotaoAnalise() {
            var qtdRadioButtonSimNao = $('.aprovacao').length;
            var qtdSim = 0;

            $(".aprovacao").each(function() {
                if($(this).is(':checked')){
                    if($(this).val() == 1){
                        qtdSim = qtdSim + 1;
                    }
                }
            });

            if(qtdSim == (qtdRadioButtonSimNao / 2)){
                $("#analise-processo").html("<i class='fa-solid fa-layer-group'></i> Gerar Processo");
            }else{
                $("#analise-processo").html("<i class='fa-solid fa-arrow-rotate-left'></i> Notificar Análise");
            }

        }

        /*
        function exibeBotaoAnalise() {
            var qtdRadioButtonSimNao = $('.aprovacao').length;
            var qtdSim = 0;

            $(".aprovacao").each(function() {
                if($(this).is(':checked')){
                    if($(this).val() == 1){
                        qtdSim = qtdSim + 1;
                    }
                }
            });

            if(qtdSim == (qtdRadioButtonSimNao / 2)){

                $("#button-mesclar").css("visibility", "visible");
                $("#button-mesclar").html("<i class='fa-solid fa-layer-group'></i> Gerar Processo");

            }else{
                $("#button-mesclar").css("visibility", "visible");
                $("#button-mesclar").html("<i class='fa-solid fa-arrow-rotate-left'></i> Retornar Origem");
            }

        }
        */

    </script>

@endsection


