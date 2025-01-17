@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Listar Regionais</h2>
        {{-- <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Regionais</a></li>
        </ol> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-2 mb-2"> <a href="{{ route('regional.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a></span>
        </div>

        <div class="card-body">

            <x-alert />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="d-none d-md-table-cell">Ativo</th>
                        <th class="d-none d-md-table-cell">Municípios</th>
                        <th class="d-none d-md-table-cell">Cadastrado</th>
                        <th width="18%">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($regionais as $regional)
                        <tr>
                            <td>{{ $regional->id }}</th>
                            <td>{{ $regional->nome }}</td>
                            <td>{{ $regional->ativo == 1 ? "Sim" : "Não" }}</td>
                            <td>{{ $regional->qtdmunicipiosvinc($regional->id) > 0 ? $regional->qtdmunicipiosvinc($regional->id) : ''  }}</td>
                            <td>{{ \Carbon\Carbon::parse($regional->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="flex-row d-md-flex justify-content-start">

                                <a href="{{ route('regional.edit', ['regional' => $regional->id]) }}" class="mb-1 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>

                                @if($regional->qtdmunicipiosvinc($regional->id) == 0)
                                    <form id="formDelete{{ $regional->id }}" method="POST" action="{{ route('regional.destroy', ['regional' => $regional->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 btnDelete" data-delete-entidade="Regional" data-delete-id="{{ $regional->id }}"  data-value-record="{{ $regional->nome }}">
                                            <i class="fa-regular fa-trash-can"></i> Apagar
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-1 mb-1"  title="há municípios vinculados!"> <i class="fa-solid fa-ban"></i> Apagar </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhuma regional encontrada!</div>
                    @endforelse

                </tbody>
            </table>

            {{ $regionais->links() }}


        </div>

    </div>

</div>


@endsection

@section('scripts')

@endsection
