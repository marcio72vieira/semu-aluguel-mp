@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">REQUERENTES - lista</h2>
        {{-- <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Requerentes</a></li>
        </ol> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-1 mb-1">
                <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a>
                {{-- <a href="{{ route('user.pdflistusers') }}" class="btn btn-danger btn-sm me-1" target="_blank"><i class="fa-solid fa-file-pdf"></i> pdf</a> --}}
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
                        <th class="d-none d-md-table-cell">Unidade Atendimento</th>
                        <th class="d-none d-md-table-cell">Município</th>
                        <th>Telefones</th>
                        <th class="d-none d-md-table-cell">CPF / RG</th>
                        <th class="d-none d-md-table-cell">Status</th>
                        <th width="35%">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($requerentes as $requerente)
                        <tr>
                            <td>{{ $requerente->id }}</th>
                            <td>{{ $requerente->nomecompleto }}</th>
                            <td>{{ $requerente->unidadeatendimento->nome }}</td>
                            <td>{{ $requerente->municipio->nome }}</td>
                            <td>{{ $requerente->foneresidencial }} <br> {{ $requerente->fonecelular }} </td>
                            <td>{{ $requerente->cpf }} <br> {{ $requerente->rg }} {{ $requerente->orgaoexpedidor }}</td>
                            {{-- <td>{{ ($requerente->status == 1 ? "...andamento" : ($requerente->status == 2 ? "...análise" : "pendente")) }}</td> --}}
                            {{-- <td>{{ ($requerente->status == 1 ? "...andamento" : ($requerente->status == 2 ? "...análise" : ($requerente->status == 3 ? "pendente" : "concluído" ))) }}</td> --}}
                            <td>
                                {{-- Andamento -  O Assistente Social cadastrou a requernete, mas falta cadastrar todos os documentos. Deixou de cadastrar alguns documentos por alguma razão --}}
                                @if($requerente->status == 1) <span style="font-size: 14px; cursor:pointer;" title="Falta anexar os documentos exigidos!"> <i class="fa-solid fa-shoe-prints"></i> andamento </span> @endif
                                {{-- Análise - O assistene Social anexou os documentos exigidos e clicou no botão "Submeter Análise" --}}
                                @if($requerente->status == 2) <span style="font-size: 14px; cursor:pointer;" title="Aguardando ser analisado!"> <i class="fa-solid fa-user-check"></i> análise  </span> @endif
                                {{-- Pendente - O Servidor da SEMU, detectou alguma inconsistência no processo de análise dos documentos anexados --}}
                                @if($requerente->status == 3) <span style="font-size: 14px; cursor:pointer;" title="Foram detectadas inconsistências nos documentos analisados!"> <i class="fa-solid fa-clock-rotate-left"></i> pendente  </span> @endif
                                {{-- Concluído - A análise foi realizada com sucesso, nenhuma inconsistência foi encontrad e o processo foi gerado com êxito --}}
                                @if($requerente->status == 4) <span style="font-size: 14px; cursor:pointer;" title="Processo gerado e arquivado com sucesso!"> <i class="fa-regular fa-circle-check"></i> concluído  </span> @endif
                            </td>
                            <td class="flex-row d-md-flex justify-content-start align-content-stretch flex-wrap">
                                {{-- <a href="{{ route('requerimento.index', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-info btn-sm me-1"> <i class="fa-regular fa-paste"></i> Requerimento </a> --}}

                                <a href="{{ route('requerente.show', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-primary btn-sm me-1">
                                    <i class="fa-regular fa-eye"></i> Visualizar
                                </a>

                                <a href="{{ route('requerente.edit', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>

                                <a href="{{ route('requerente.relpdfrequerente', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-danger btn-sm me-1" target="_blank">
                                    <i class="fa-solid fa-file-pdf"></i> Anexos
                                </a>
                                {{-- <a href="{{ route('documento.index', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-info btn-sm me-1">
                                    <i class="fas fa-upload"></i> Documentos
                                </a> --}}

                                <a href="{{ route('documento.create', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-info btn-sm me-1">
                                    <i class="fas fa-upload"></i> Documentos
                                </a>

                                {{-- <a href="{{ route('documento.index', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-list-check"></i> Check List
                                </a> --}}

                                <a href="{{ route('documento.pendentes', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-list-check"></i> Pendências...
                                </a>

                                <form id="formDelete{{ $requerente->id }}" method="POST" action="{{ route('requerente.destroy', ['requerente' => $requerente->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="mb-3 btn btn-danger btn-sm me-1 btnDelete" data-delete-entidade="Requerente" data-delete-id="{{ $requerente->id }}"  data-value-record="{{ $requerente->nomecompleto }}">
                                        <i class="fa-regular fa-trash-can"></i> Apagar
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum Requerente encontrado!</div>
                    @endforelse
                </tbody>
            </table>

            {{ $requerentes->links() }}


        </div>

    </div>

</div>


@endsection

