@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Anexos - {{ $requerente->nomecompleto }}</h2>
        {{-- <span class="ms-auto d-sm-flex flex-row mt-1 mb-1 mt-3">
            <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fas fa-upload"></i> Adicionar </a>
        </span> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-1 mb-1">
                <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index')}}" role="button">Cancelar</a>
                <a class="btn btn-success me-1" href="{{ route('anexo.create', ['requerente' => $requerente->id]) }}"><i class="fas fa-upload"></i> Adicionar </a>
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
                        <th class="d-none d-md-table-cell">Anexo</th>
                        <th width="25%">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($anexos as $anexo)
                        <tr>
                            <td>{{ $anexo->id }}</th>
                            <td>{{ $anexo->nome }}</th>
                            <td style="text-align: center">
                                <a href="{{asset('/storage/'.$anexo->url)}}" target="_blank">
                                    <img src="{{asset('images/icopdf.png')}}" width="20">
                                </a>
                            </td>
                            <td class="flex-row d-md-flex justify-content-start align-content-stretch flex-wrap">
                                <form id="formDelete{{ $requerente->id }}" method="POST" action="{{ route('anexo.destroy', ['anexo' => $anexo->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="mb-3 btn btn-danger btn-sm me-1 btnDelete" data-delete-entidade="Requerente" data-delete-id="{{ $requerente->id }}"  data-value-record="{{ $requerente->nomecompleto }}">
                                        <i class="fa-regular fa-trash-can"></i> Apagar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum Anexo encontrado!</div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

