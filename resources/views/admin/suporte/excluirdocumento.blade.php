@extends('layout.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">EXCLUIR DOCUMENTOS - {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} / Quantidade: {{ $requerente->docsAnexados($requerente->id) }}</h2>
        </div>

        <div class="mb-4 shadow card border-light">

            {{-- Início Lista de documentos anexados --}}
            <div class="card-body">

                <x-alert />

                {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
                <x-errorexception />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ordem</th>
                            <th>Documento</th>
                            <th>Visualizar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($documentos as $documento)
                            <tr>
                                <td>{{ $documento->id }}</th>
                                <td>{{ $documento->ordem }}</td>
                                <td>{{ $documento->tipodocumento->nome }}</th>
                                <td> <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank" title="Visualizar este documento"> <img src="{{ asset('images/documentos2.png') }}" width="30" style="margin-left: 25px;"> </a></td>
                                <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch">
                                    <form id="formDelete{{ $documento->id }}" method="POST" action="{{ route('suporte.excluirdocumento', ['documento' => $documento->id]) }}" style="margin-left: 10px;" title="Excluir este documento">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm btnDelete" data-delete-entidade="Documento" data-delete-id="{{ $documento->id }}"  data-value-record="{{ $documento->tipodocumento->nome }}">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum documento anexado para exclusão! </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- fim Lista de documentos anexados--}}

            <div class="row">
                <div class="col-1 offset-11">
                    <a class="btn btn-outline-secondary me-2" href="{{ route('suporte.listarrequerentes') }}" role="button" style="margin-left: 10px; margin-bottom: 15px; ">Cancelar</a>
                </div>
            </div>

        </div>
    </div>

@endsection

