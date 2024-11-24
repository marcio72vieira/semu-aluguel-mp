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

                        {{-- tipodocumento_id --}}
                        {{-- identificacao da ordem do documento --}}
                        <input type="hidden" name="ordem_hidden" id="ordem_hidden" value="1">
                        <div class="col-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="tipodocumento_id">Documento<span class="small text-danger">*</span>
                                    <span>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Documentos Anexados">
                                            <i class="fas fa-question-circle"></i>
                                        </a>
                                    </span>
                                </label>

                                {{-- {{ $documentosAnexados = $documentos->count() }} de {{ $totalTipoDocumentoAtivo = $tiposdocumentos->count() }} --}}

                                <select name="tipodocumento_id" id="tipodocumento_id" class="form-control select2" required>
                                    <option value="" selected disabled>Escolha...</option>
                                    @foreach($tiposdocumentos  as $tipodocumento)
                                        {{-- Exibe todos os documentos para seleção, exceto documentos processados  @if ($tipodocumento->id != 1) ... @endif --}}
                                        <option value="{{$tipodocumento->id}}" {{ old('tipodocumento_id') == $tipodocumento->id ? 'selected' : '' }} data-tipodocumento_ordem = "{{ $tipodocumento->ordem }}" style="font-color: red">
                                            {{ $tipodocumento->nome }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="hidden" name="tipodocumento_ordem_hidden" id="tipodocumento_ordem_hidden"  value="">
                                @error('tipodocumento_id')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex-row col-2 d-md-flex justify-content-end">
                            <div style="margin-top: 25px">
                                {{-- <a class="btn btn-outline-secondary me-2" href="{{ url()->previous() }}" role="button">Cancelar</a> --}}
                                <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index') }}" role="button">Cancelar</a>
                                <button type="submit" class="btn btn-primary " style="width: 95px;"> Anexar </button>
                            </div>
                        </div>

                    </div>
                </form>


            </div>

            {{-- Início Lista de documentos  --}}
            <div class="card-body">

                <hr style="border: none; height: 3px; background-color: #545454;">

                {{-- @dd($documentos) --}}

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
                            {{-- Exibia todos os documentos anexados do requerente, com exceção do documento processado pelo servidor da semu   @if ($documento->tipodocumento_id != 1) ... @endif --}}
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
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum documento vinculado! </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- fim Lista de documentos --}}

            <div class="row">
                <div class="col-2 offset-10">
                    {{-- Butão deve ser exibido quando todos os documentos exigidos estiverem anexados
                         O campo status (pendente) tabela "requerente" deverá ser atualizado para "em análise"
                         Desabilitar todas as operações ref. ao requerente, ou seja, desabillitar: nem cadastrar, nem editar, nem consultar, anexos e documentos
                    --}}
                    @if ($documentos->count() >= $tiposdocumentos->count())
                        <a class="btn btn-success me-2" href="" role="button"  style="margin-left: 10px; margin-bottom: 15px; width: 200px;"><i class="fa-solid fa-user-check" style="margin-right: 5px;"></i> Submeter a Análise</a>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">DOCUMENTOS JÁ ANEXADOS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-sm">

                        <tbody>
                            @foreach($tiposdocumentos  as $tipodocumento)
                                <tr>
                                    <td>
                                        <span style="font-size: 12px;">{{$tipodocumento->nome}}</span>
                                        @foreach ( $documentos as $documento )
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
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
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

