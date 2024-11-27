@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">CHECK LIST - REQUERENTES</h2>
        {{-- <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Requerentes</a></li>
        </ol> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="card-header hstack gap-2">
            <span class="ms-auto d-sm-flex flex-row mt-1 mb-1">
                <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-solid fa-magnifying-glass"></i> Filtrar </a>
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
                        <th>Requerente</th>
                        <th class="d-none d-md-table-cell">Município</th>
                        <th class="d-none d-md-table-cell">Unidade Atendimento</th>
                        <th>Assitente Social</th>
                        <th>Telefones</th>
                        <th class="d-none d-md-table-cell">Status</th>
                        <th width="35%">Ação</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($requerentes as $requerente)
                        <tr>
                            <td>{{ $requerente->id }}</th>
                            <td>{{ $requerente->nomecompleto }}</th>
                                <td>{{ $requerente->municipio->nome }}</td>
                            <td>{{ $requerente->unidadeatendimento->nome }}</td>
                            <td>{{ $requerente->user->nomecompleto }}</td>
                            <td>{{ $requerente->foneresidencial }} <br> {{ $requerente->fonecelular }} </td>
                            <td>
                                @if($requerente->status == 1) <span style="font-size: 14px;"> <i class="fa-solid fa-shoe-prints"></i> em andamento </span> @endif  {{-- falta anexar todos os documentos --}}
                                @if($requerente->status == 2) <span style="font-size: 14px;"> <i class="fa-solid fa-user-check"></i> em análise  </span> @endif    {{-- os documentos foram enviados para análise depois de anexar os documentos --}}
                                @if($requerente->status == 3) <span style="font-size: 14px;"> <i class="fa-solid fa-clock-rotate-left"></i> pendente  </span> @endif {{-- falta anexar documents --}}
                                @if($requerente->status == 4) <span style="font-size: 14px;"> <i class="fa-regular fa-circle-check"></i> concluído  </span> @endif {{-- O check list foi feito e o processo foi gerado --}}
                            </td>
                            <td class="flex-row d-md-flex justify-content-start align-content-stretch flex-wrap">
                                <a href="{{ route('documento.index', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-warning btn-sm me-1">
                                    <i class="fa-solid fa-list-check"></i> Analisar documentos
                                </a>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum Requerente para ser análise encontrado!</div>
                    @endforelse
                </tbody>
            </table>

            {{ $requerentes->links() }}


        </div>

    </div>

</div>


@endsection

