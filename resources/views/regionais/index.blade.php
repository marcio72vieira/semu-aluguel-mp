@extends('layout.admin')

@section('content')

<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Listar Regionais</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Regionais</a></li>
        </ol>
    </div>

    <div class="container-fluid px-4">

        <div class="mb-4 shadow card border-light">
            <div class="card-header hstack gap-2">
                <span class="ms-auto d-sm-flex flex-row"> <a href="{{ route('regional.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a></span>
            </div>

            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th class="d-none d-md-table-cell">Ativo</th>
                            <th class="d-none d-md-table-cell">Cadastrado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($regionais as $regional)
                            <tr>
                                <td>{{ $regional->id }}</th>
                                <td>{{ $regional->nome }}</td>
                                <td>{{ $regional->ativo == 1 ? "Sim" : "Não" }}</td>
                                <td>{{ \Carbon\Carbon::parse($regional->created_at)->format('d/m/Y H:i') }}</td>
                                <td class="flex-row d-md-flex justify-content-center">
                                    <a href="" class="mb-1 btn btn-primary btn-sm me-1">
                                        <i class="fa-regular fa-eye"></i> Visualizar
                                    </a>

                                    <a href="{{ route('regional.edit', ['regional' => $regional->id]) }}" class="mb-1 btn btn-warning btn-sm me-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </a>

                                    <form method="POST" action="">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="mb-1 btn btn-danger btn-sm me-1"
                                            onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                                class="fa-regular fa-trash-can"></i> Apagar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum usuário encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

                {{ $regionais->links() }}
                    

            </div>

        </div>
    </div>
</div>


@endsection

@section('scripts')

@endsection
