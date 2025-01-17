@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Listar Municípios</h2>
        {{-- <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Municípios</a></li>
        </ol> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-2 mb-2"> <a href="{{ route('municipio.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a></span>
        </div>

        <div class="card-body">

            <x-alert />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="d-none d-md-table-cell">Regional</th>
                        <th class="d-none d-md-table-cell">Ativo</th>
                        <th class="d-none d-md-table-cell">Unidades</th>
                        <th class="d-none d-md-table-cell">Cadastrado</th>
                        <th width="18%">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($municipios as $municipio)
                        <tr>
                            <td>{{ $municipio->id }}</th>
                            <td>{{ $municipio->nome }}</td>
                            <td>{{ $municipio->regional->nome }}</td>
                            <td>{{ $municipio->ativo == 1 ? "Sim" : "Não" }}</td>
                            <td>{{ $municipio->qtdunidadeatendimentovinc($municipio->id) > 0 ? $municipio->qtdunidadeatendimentovinc($municipio->id) : ''  }}</td>
                            <td>{{ \Carbon\Carbon::parse($municipio->created_at)->format('d/m/Y') }}</td>
                            <td class="flex-row d-md-flex justify-content-start">

                                <a href="{{ route('municipio.edit', ['municipio' => $municipio->id]) }}" class="mb-1 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>

                                @if($municipio->qtdunidadeatendimentovinc($municipio->id) == 0)
                                    <form id="formDelete{{ $municipio->id }}" method="POST" action="{{ route('municipio.destroy', ['municipio' => $municipio->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="mb-1 btn btn-danger btn-sm me-1  btnDelete" data-delete-entidade="Município" data-delete-id="{{ $municipio->id }}"  data-value-record="{{ $municipio->nome }}">
                                            <i class="fa-regular fa-trash-can"></i> Apagar
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-1 mb-1"  title="há unidades vinculadas!"> <i class="fa-solid fa-ban"></i> Apagar </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum município encontrado!</div>
                    @endforelse

                </tbody>
            </table>

            {{ $municipios->links() }}


        </div>

    </div>

</div>


@endsection

@section('scripts')

@endsection
