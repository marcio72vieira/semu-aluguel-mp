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
                                <label class="form-control-label" for="url">Arquivo do Documento (o arquivo deve ser do tipo .pdf)<span class="small text-danger">*</span></label>
                                <input type="file" id="url" style="display:block" name="url" value="{{ old('url') }}">
                                @error('url')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- tipodocumento_id --}}
                        {{-- identificacao da ordem do documento --}}
                        <input type="hidden" name="ordem_hidden" id="ordem_hidden" value="1">
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="tipodocumento_id">Documento<span class="small text-danger">*</span></label>
                                <select name="tipodocumento_id" id="tipodocumento_id" class="form-control select2" required>
                                    <option value="" selected disabled>Escolha...</option>

                                    @foreach($tiposdocumentos  as $tipodocumento)
                                        {{-- Exibe todos os documentos para seleção, exceto documentos processados --}}
                                        @if ($tipodocumento->id != 13)
                                            <option value="{{$tipodocumento->id}}" {{ old('tipodocumento_id') == $tipodocumento->id ? 'selected' : '' }} data-tipodocumento_ordem = "{{ $tipodocumento->ordem }}" style="font-color: red">
                                                {{ $tipodocumento->nome }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                                <input type="hidden" name="tipodocumento_ordem_hidden" id="tipodocumento_ordem_hidden"  value="">
                                @error('tipodocumento_id')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex-row col-4 d-md-flex justify-content-end">
                            <div style="margin-top: 25px">
                                {{-- <a class="btn btn-outline-secondary me-2" href="{{ url()->previous() }}" role="button">Cancelar</a> --}}
                                <a class="btn btn-outline-secondary me-2" href="{{ route('documento.index', ['requerente' => $requerente->id]) }}" role="button">Cancelar</a>
                                <button type="submit" class="btn btn-primary me-4" style="width: 95px;"> Anexar </button>
                                {{-- Quando submeter para análise, o campo pendente(status) na tabela requerente deverá ser atualizado para "em análise e nada mais poderá ser feito em relação ao requerente, ou seja, nem cadastrar, nem editar, nem apagar" --}}
                                <a class="btn btn-outline-secondary me-2" href="" role="button"><i class="fa-solid fa-paper-plane"></i> Submeter aAnálise</a>
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
                            {{-- Exibe todos os documentos anexados do requerente, com exceção do documento processado pelo servidor da semu  --}}
                            @if ($documento->tipodocumento_id != 13)
                                <tr>
                                    <td>{{ $documento->id }}</th>
                                    <td>{{ $documento->tipodocumento->nome }}</th>
                                    <td> <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank"> <img src="{{ asset('images/icopdf3.png') }}" width="30" style="margin-left: 25px;"> </a></td>
                                    <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch">
                                        <form id="formDelete{{ $documento->id }}" method="POST" action="{{ route('documento.destroy', ['documento' => $documento->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm btnDelete" data-delete-entidade="Documento" data-delete-id="{{ $documento->id }}"  data-value-record="{{ $documento->tipodocumento->nome }}">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum documento encontrado! </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- fim Lista de documentos --}}

        </div>


    </div>
@endsection

@section('scripts')
    <script>
        // Atribui ao campo hidden o valor da ordem do tipo de documento atraves da propriedade "data-"
        $("#tipodocumento_id").on("change", function() {

            tipodocumentoordem = $(this).find(':selected').data('tipodocumento_ordem')
                $(this).siblings("#tipodocumento_ordem_hidden").val(tipodocumentoordem);

        });
    </script>

@endsection

