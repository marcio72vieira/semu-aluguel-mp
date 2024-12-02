@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">USUÁRIOS - lista</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Usuários</a></li>
        </ol>
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-1 mb-1">
                <a href="{{ route('user.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a>
                <a href="{{ route('user.pdflistusers') }}" class="btn btn-danger btn-sm me-1" target="_blank"><i class="fa-solid fa-file-pdf"></i> pdf</a>
            </span>
        </div>

        <div class="card-body">

            <x-alert />

            {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
            <x-errorexception />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Perfil</th>
                        <th class="d-none d-md-table-cell">Município</th>
                        <th class="d-none d-md-table-cell">Unidade Atendimento</th>
                        <th>Telefone</th>
                        <th class="d-none d-md-table-cell">Ativo</th>
                        <th class="d-none d-md-table-cell">Requisições Aluguel</th>
                        <th class="d-none d-md-table-cell">Cadastrado</th>
                        <th width="18%">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</th>
                            <td>{{ $user->nomecompleto }}</th>
                                <td>{{ ($user->perfil == "adm" ? "ADMINISTRADOR" : ($user->perfil == "srv" ? "SERVIDOR SEMU" : "ASS. SOCIAL")) }}</th>
                            <td>{{ $user->municipio->nome }}</td>
                            <td>{{ $user->unidadeatendimento->nome }}</td>
                            <td>{{ $user->fone }}</td>
                            <td>{{ $user->ativo == 1 ? "Sim" : "Não" }}</td>
                            <td>0</td>{{-- quantas requisições foram cadastradas analisadas pelo usuário --}}
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                            
                            <td class="flex-row d-md-flex justify-content-start">
                                <a href="{{ route('user.show', ['user' => $user->id]) }}" class="mb-1 btn btn-primary btn-sm me-1">
                                    <i class="fa-regular fa-eye"></i> Visualizar
                                </a>

                                <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="mb-1 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>

                                @if(2 > 1)
                                    <form id="formDelete{{ $user->id }}" method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="mb-1 btn btn-danger btn-sm me-1 btnDelete" data-delete-entidade="Usuário" data-delete-id="{{ $user->id }}"  data-value-record="{{ $user->nome }}">
                                            <i class="fa-regular fa-trash-can"></i> Apagar
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-1 mb-1"  title="há processos vinculados!"> <i class="fa-regular fa-trash-can"></i> Apagar </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum Usuário encontrada!</div>
                    @endforelse

                </tbody>
            </table>

            {{ $users->links() }}


        </div>

    </div>

</div>


@endsection

