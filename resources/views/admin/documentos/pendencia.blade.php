@extends('layout.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">PENDÊNCIAS - {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} </h2>
        </div>

        <div class="mb-4 shadow card border-light">
            <div class="gap-2 card-header hstack">
                <span class="p-3 small text-danger"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            {{-- Início Lista de documentos anexados --}}
            <div class="card-body">
                
                <x-alert />

                {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
                <x-errorexception />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Documento</th>
                            <th>Observação</th>
                            <th>Corrigido {{-- Excluir --}}</th>
                            <th>Visualizar</th>
                            <th>Documento corrigido</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $qtd_documentos_reprovados = $documentos->count();
                            $qtd_documentos_corrigidos = 0;
                        @endphp

                        @forelse ($documentos as $documento)
                            <tr>
                                <td>{{ $documento->id }}</th>
                                <td>{{ $documento->tipodocumento->nome }}</th>
                                <td>{{ $documento->observacao }}</td>                    
                                <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch">
                                    @if ($documento->corrigido == 1) 
                                        {{-- Acrescenta + 1 toda vez que um documento for corrigido --}}
                                        @php $qtd_documentos_corrigidos = $qtd_documentos_corrigidos + 1 @endphp
                                        <b><i class='mr-2 fas fa-check text-success' style="margin-left: 25px; font-size: 30px;"></i></b> 
                                    @else
                                        <b><i class='mr-2 fa-solid fa-xmark text-danger' style="margin-left: 25px; font-size: 30px;"></i></b> 
                                    @endif
                                    {{-- 
                                        Só possibilita a exclusão dos documentos pendentes. Esta exclusão é necessária caso algum documento duplicado, como foi o caso verificado nos testes
                                    @if ($documento->aprovado == 0)
                                        <form id="formDelete{{ $documento->id }}" method="POST" action="{{ route('documento.destroy', ['documento' => $documento->id]) }}" style="margin-left: 10px;" title="Excluir este documento">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm btnDelete" data-delete-entidade="Documento" data-delete-id="{{ $documento->id }}"  data-value-record="{{ $documento->tipodocumento->nome }}">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary btn-sm" title="Documento aprovado!" style="margin-left: 10px;"> <i class="fa-solid fa-ban"></i> </button>
                                    @endif
                                     --}}
                                </td>
                                <td> <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank" title="Visualizar este documento"> <img src="{{ asset('images/documentos2.png') }}" width="30" style="margin-left: 25px;"> </a></td>
                                <td>
                                    <form action="{{ route('documento.replace') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="file" name="url"  id="url" style="display:block" value="{{ old('url') }}">
                                                <input type="hidden" name="documento_id" id="documento_id"  value="{{ $documento->id }}">
                                                <input type="hidden" name="nome_arquivo_antigo" id="nome_arquivo_antigo"  value="{{ explode('/', $documento->url)[2] }}">
                                                <input type="hidden" name="tipodocumento_id" id="tipodocumento_id"  value="{{ $documento->tipodocumento->id }}">
                                                <input type="hidden" name="tipodocumento_ordem_hidden" id="tipodocumento_ordem_hidden"  value="{{ $documento->tipodocumento->ordem }}">
                                                <input type="hidden" name="requerente_id_hidden" id="requerente_id_hidden" value="{{ $requerente->id }}">
                                            </div>
                                            <div class="col-1">
                                                <button type="submit" class="btn btn-primary btn-sm" title="Substituir"><i class="fa-solid fa-right-left"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum documento com pendência encontrado! </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- fim Lista de documentos anexados offset-8 --}}

            <div class="row">
                <div class="col-1 offset-9" style="text-align: right">
                    <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index') }}" role="button" style="margin-bottom: 15px;">Cancelar</a>
                </div>
                <div class="col-2">
                    {{-- Só exibe o formulário com o botão se documentos_corrigidos for maior ou igual (um documento pode ser corrigido mais de uma vez) a quantidade de docuemtnos reprovados --}}
                    @if ($qtd_documentos_corrigidos >=  $qtd_documentos_reprovados)
                        <form action="{{ route('documento.submeteranalise', ['requerente' => $requerente->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            {{-- status = 4, significa que os documetos foram corrigidos --}}
                            <input type="hidden" name="status_hidden" value="4">
                            <button type="submit" class="btn btn-success me-2" style="margin-bottom: 15px;"><i class="fa-solid fa-user-check" style="margin-right: 5px;"></i> Submeter a Reanálise</button>
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


