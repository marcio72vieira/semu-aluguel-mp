@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Listar Tipos de Unidade</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Tipos de Unidade</a></li>
        </ol>
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-2 mb-2"> <a href="{{ route('tipounidade.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a></span>
        </div>

        <div class="card-body">

            <x-alert />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="d-none d-md-table-cell">Ativo</th>
                        <th class="d-none d-md-table-cell">Unidades</th>
                        <th class="d-none d-md-table-cell">Cadastrado</th>
                        <th width="18%">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($tipounidades as $tipounidade)
                        <tr>
                            <td>{{ $tipounidade->id }}</th>
                            <td>{{ $tipounidade->nome }}</td>
                            <td>{{ $tipounidade->ativo == 1 ? "Sim" : "Não" }}</td>
                            <td>{{ $tipounidade->qtdunidadesatendimento($tipounidade->id) > 0 ? $tipounidade->qtdunidadesatendimento($tipounidade->id) : ''  }}</td>
                            <td>{{ \Carbon\Carbon::parse($tipounidade->created_at)->format('d/m/Y') }}</td>
                            <td class="flex-row d-md-flex justify-content-start">
                                <a href="" class="mb-1 btn btn-primary btn-sm me-1"> <i class="fa-regular fa-eye"></i> Visualizar </a>

                                <a href="{{ route('tipounidade.edit', ['tipounidade' => $tipounidade->id]) }}" class="mb-1 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>

                                @if($tipounidade->qtdunidadesatendimento($tipounidade->id) == 0)
                                    <form method="POST" action="{{ route('tipounidade.destroy', ['tipounidade' => $tipounidade->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="mb-1 btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                            <i class="fa-regular fa-trash-can"></i> Apagar
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-1 mb-1"  title="há unidades vinculadas!"> <i class="fa-regular fa-trash-can"></i> Apagar </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum tipo encontrado!</div>
                    @endforelse

                </tbody>
            </table>

            {{ $tipounidades->links() }}


        </div>

    </div>

</div>


@endsection

@section('scripts')

@endsection
