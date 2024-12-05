@extends('layout.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">Documentos - {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} </h2>
        </div>

        <div class="mb-4 shadow card border-light">
            <div class="gap-2 card-header hstack">
                <span class="p-3 small text-danger"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            {{-- Formulário para anexar documentos --}}
            <div class="card-body">
                <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('POST')

                    <div class="row">
                        {{-- identificacao do requerente --}}
                        <input type="hidden" name="requerente_id_hidden" id="requerente_id_hidden" value="{{ $requerente->id }}">


                        {{-- url--}}
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="url">Arquivo do Documento (Arquivo do tipo .pdf e máximo de 2Mb)<span class="small text-danger">*</span></label>
                                <input type="file" id="url" style="display:block" name="url" value="{{ old('url') }}">
                                @error('url')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- identificacao da ordem do documento --}}
                        <input type="hidden" name="ordem_hidden" id="ordem_hidden" value="1">

                        {{-- tipodocumento_id --}}
                        <div class="col-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="tipodocumento_id">Documento exigido <span class="small text-danger">*</span>
                                    {{-- Exibe a modal com os documentos que já foram anexados para guiar o assistente social --}}
                                    <span>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Documentos Anexados">
                                            <i class="fas fa-question-circle"style="font-size: 15px; margin-left: 10px;"></i>
                                        </a>
                                    </span>
                                </label>

                                {{-- {{ $documentosAnexados = $documentos->count() }} de {{ $totalTipoDocumentoAtivo = $tiposdocumentos->count() }} --}}

                                @php
                                    // Arrays para recuperar todos os TIPOSDEDOCUMENTOS(ativos) e DOCUEMNTOS(à medida que forem anexados)
                                    $arr_tiposdocumentos = [];
                                    $arr_documentos = [];
                                @endphp

                                <select name="tipodocumento_id" id="tipodocumento_id" class="form-control select2" required>
                                    <option value="" selected disabled>Escolha...</option>
                                    @foreach($tiposdocumentos  as $tipodocumento)
                                        <option value="{{$tipodocumento->id}}" {{ old('tipodocumento_id') == $tipodocumento->id ? 'selected' : '' }} data-tipodocumento_ordem = "{{ $tipodocumento->ordem }}" style="font-color: red">
                                            {{ $tipodocumento->nome }}
                                        </option>

                                        {{-- Populando arr_tiposdocumentos --}}
                                        @php $arr_tiposdocumentos[] = $tipodocumento->id; @endphp

                                    @endforeach
                                </select>

                                <input type="hidden" name="tipodocumento_ordem_hidden" id="tipodocumento_ordem_hidden"  value="{{ old('tipodocumento_ordem_hidden')}}">

                                @error('tipodocumento_id')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex-row col-2 d-md-flex justify-content-end">
                            <div style="margin-top: 25px">
                                <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index') }}" role="button">Retornar</a>
                                <button type="submit" class="btn btn-primary " style="width: 95px;"> Anexar </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            {{-- Início Lista de documentos anexados --}}
            <div class="card-body">

                <hr style="border: none; height: 3px; background-color: #545454;">

                <x-alert />

                {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
                <x-errorexception />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Documento</th>
                            <th>Visualizar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($documentos as $documento)
                            <tr>
                                <td>{{ $documento->id }}</th>
                                <td>{{ $documento->tipodocumento->nome }}</th>
                                <td> <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank" title="Visualizar este documento"> <img src="{{ asset('images/documentos2.png') }}" width="30" style="margin-left: 25px;"> </a></td>
                                <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch">
                                    <form id="formDelete{{ $documento->id }}" method="POST" action="{{ route('documento.destroy', ['documento' => $documento->id]) }}" style="margin-left: 10px;" title="Excluir este documento">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm btnDelete" data-delete-entidade="Documento" data-delete-id="{{ $documento->id }}"  data-value-record="{{ $documento->tipodocumento->nome }}">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Populando arr_documentos, à medida que forem sendo anexados --}}
                             @php $arr_documentos[] = $documento->tipodocumento_id; @endphp

                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum documento anexado! </div>
                        @endforelse
                    </tbody>
                </table>

                {{-- Transformando os arrays em string // {{ implode(",", $arr_tiposdocumentos) }} <br> {{ implode(",", $arr_documentos) }} --}}
                {{-- Comparando quantidade de elementos das coleções: @if ($documentos->count() >= $tiposdocumentos->count()) ...faz alguma coisa.. @endif --}}

                {{-- Removendo os elementos duplicados do array documentos, para que seu tamanho, seja comparado com a quantidade de elemntos do array tiposdocumntos --}}
                @php $arr_documentos = array_unique($arr_documentos); @endphp
            </div>
            {{-- fim Lista de documentos anexados--}}

            <div class="row">
                <div class="col-2 offset-10">
                    {{-- Butão deve ser exibido quando todos os documentos exigidos estiverem anexados
                         O campo status (pendente) tabela "requerente" deverá ser atualizado para "em análise"
                         Desabilitar todas as operações ref. ao requerente, ou seja, desabillitar: nem cadastrar, nem editar, nem consultar, anexos e documentos


                    --}}
                    {{-- Só exibe o formulário com o botão se todos os documentos exigidos forem anexados --}}
                    @if (count($arr_documentos) ==  count($arr_tiposdocumentos))
                        <form action="{{ route('documento.submeteranalise', ['requerente' => $requerente->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            {{-- status = 2, significa que os documetos foram colocados para análise --}}
                            <input type="hidden" name="status_hidden" value="2">
                            <button type="submit" class="btn btn-success me-2" style="margin-left: 10px; margin-bottom: 15px; width: 200px;"><i class="fa-solid fa-user-check" style="margin-right: 5px;"></i> Submeter a Análise</button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- inicio modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">DOCUMENTOS ANEXADOS</h2>
                </div>

                <div class="modal-body">
                    <table class="table table-sm">
                        <tbody>
                            @foreach($tiposdocumentos  as $tipodocumento)
                                <tr>
                                    <td>
                                        <span style="font-size: 12px;">{{$tipodocumento->nome}}</span>
                                    </td>
                                    <td>
                                        @foreach ($documentos as $documento )
                                            @if ($documento->tipodocumento_id == $tipodocumento->id)
                                                <b><i class='mr-2 fas fa-check text-success' style="font-size: 30px;"></i></b>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fim modal --}}

@endsection

@section('scripts')
    <script>
        // Atribui ao campo hidden o valor da ordem do tipo de documento atraves da propriedade "data-"
        // Essa ordem é necessária para compor o nome do arquivo físico (Ex: doc_01_tempo.pdf, doc_02_tempo.pdf, ... doc_10_tempo.pdf)
        // que é de fundamental importância para a ordem de mesclagem dos arquivos pdfs.
        // A mesclagem tem que ser na ordem do check-list fornecido pelo cliente ou qualquer outra ordem que o mesmo definir.
        // O valor do campo "tipodocumento_ordem_hidden" é fornecido pela propriedade data-, já que no select, o único valor que
        // pode ser passado para o processamento da requisição através da request, é o value da "option".
        // Resumindo. Uma forma de passar vários valores para o processamento da requisição, é através da criação de campos do
        // do tipo "hidden" e definindo seus valores através das propriedades data-, como no script abaixo.
        $("#tipodocumento_id").on("change", function() {

            let tipodocumentoordem = $(this).find(':selected').data('tipodocumento_ordem')
                $(this).siblings("#tipodocumento_ordem_hidden").val(tipodocumentoordem);

        });
    </script>

@endsection

