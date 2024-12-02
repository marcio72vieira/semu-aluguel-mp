@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">UNIDADE DE ATENDIMENTO - lista</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Unidade de Atendimento</a></li>
        </ol>
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-1 mb-1"> <a href="{{ route('unidadeatendimento.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a></span>
        </div>

        <div class="card-body">

            <x-alert />

            {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
            <x-errorexception />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Regional</th>
                        <th>Município</th>
                        <th>Ativo</th>
                        <th>Usuários</th>
                        <th>Cadastrado</th>
                        <th width="18%">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($unidadesatendimentos as $unidadeatendimento)
                        <tr>
                            <td>{{ $unidadeatendimento->id }}</th>
                            <td>{{ $unidadeatendimento->tipounidade->nome }}</th>
                            <td>{{ $unidadeatendimento->nome }}</td>
                            <td>{{ $unidadeatendimento->regional->nome }}</td>
                            <td>{{ $unidadeatendimento->municipio->nome }}</td>
                            <td>{{ $unidadeatendimento->ativo == 1 ? "Sim" : "Não" }}</td>
                            <td>{{ $unidadeatendimento->qtdusuariosdaunidade($unidadeatendimento->id) }}</td>
                            <td>{{ \Carbon\Carbon::parse($unidadeatendimento->created_at)->format('d/m/Y') }}</td>
                            <td class="flex-row d-md-flex justify-content-start">
                                <a href="{{ route('unidadeatendimento.show', ['unidadeatendimento' => $unidadeatendimento->id]) }}" class="mb-1 btn btn-primary btn-sm me-1">
                                    <i class="fa-regular fa-eye"></i> Visualizar 
                                </a>

                                <a href="{{ route('unidadeatendimento.edit', ['unidadeatendimento' => $unidadeatendimento->id]) }}" class="mb-1 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>

                                @if($unidadeatendimento->qtdusuariosdaunidade($unidadeatendimento->id) == 0)
                                    <form id="formDelete{{ $unidadeatendimento->id }}" method="POST" action="{{ route('unidadeatendimento.destroy', ['unidadeatendimento' => $unidadeatendimento->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="mb-1 btn btn-danger btn-sm me-1 btnDelete" data-delete-entidade="Unidade Atendimento" data-delete-id="{{ $unidadeatendimento->id }}"  data-value-record="{{ $unidadeatendimento->nome }}">
                                            <i class="fa-regular fa-trash-can"></i> Apagar
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-1 mb-1"  title="há usuários vinculados!"> <i class="fa-solid fa-ban"></i> Apagar </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum Unidade de Atendimento encontrada!</div>
                    @endforelse

                </tbody>
            </table>

            {{ $unidadesatendimentos->links() }}


        </div>

    </div>

</div>


@endsection

@section('scripts')

@endsection
