@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Listar Tipos de Documentos</h2>
        {{-- <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Tipos de Unidade</a></li>
        </ol> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-2 mb-2"> <a href="{{ route('tipodocumento.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a></span>
        </div>

        <div class="card-body">

            <x-alert />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ordem</th>
                        <th class="d-none d-md-table-cell">Ativo</th>
                        <th class="d-none d-md-table-cell">Documentos</th>
                        <th class="d-none d-md-table-cell">Cadastrado</th>
                        <th width="18%">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($tipodocumentos as $tipodocumento)
                        <tr>
                            <td>{{ $tipodocumento->id }}</th>
                            <td>{{ $tipodocumento->nome }}</td>
                            <td>{{ $tipodocumento->ordem }}</td>
                            <td>{{ $tipodocumento->ativo == 1 ? "Sim" : "Não" }}</td>
                            <td>{{ $tipodocumento->qtddocumentosdotipo($tipodocumento->id) > 0 ? $tipodocumento->qtddocumentosdotipo($tipodocumento->id) : ''  }}</td>
                            <td>{{ \Carbon\Carbon::parse($tipodocumento->created_at)->format('d/m/Y') }}</td>
                            <td class="flex-row d-md-flex justify-content-start">

                                <a href="{{ route('tipodocumento.edit', ['tipodocumento' => $tipodocumento->id]) }}" class="mb-1 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>

                                @if($tipodocumento->qtddocumentosdotipo($tipodocumento->id) == 0)
                                    <form id="formDelete{{ $tipodocumento->id }}"  method="POST" action="{{ route('tipodocumento.destroy', ['tipodocumento' => $tipodocumento->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="mb-1 btn btn-danger btn-sm me-1 btnDelete"  data-delete-entidade="Documento" data-delete-id="{{ $tipodocumento->id }}"  data-value-record="{{ $tipodocumento->nome }}">
                                            <i class="fa-regular fa-trash-can"></i> Apagar
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-1 mb-1"  title="há documentos vinculados!"> <i class="fa-solid fa-ban"></i> Apagar </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum Documento encontrado!</div>
                    @endforelse

                </tbody>
            </table>

            {{ $tipodocumentos->links() }}


        </div>

    </div>

</div>


@endsection

@section('scripts')

@endsection
