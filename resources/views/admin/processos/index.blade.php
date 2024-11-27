@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">PROCESSOS</h2>
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
                        <th>Município</th>
                        <th>Unidade Atendimento</th>
                        <th>Assitente Social</th>
                        <th>Funcionario SEMU</th>
                        <th>Processo</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($processos as $processo)
                        <tr>
                            <td>{{ $processo->id }}</th>
                            <td>{{ $processo->nomecompleto }}</th>
                            <td>{{ $processo->municipio }}</td>
                            <td>{{ $processo->unidadeatendimento }}</td>
                            <td>{{ $processo->assistente }}</td>
                            <td>{{ $processo->funcionario }}</td>
                            <td> <a href="{{ asset('/storage/'.$processo->url) }}" target="_blank" title="Visualizar este documento"> <img src="{{ asset('images/icopdf3.png') }}" width="30" style="margin-left: 25px;"> </a></td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum PROCESSO encontrado!</div>
                    @endforelse
                </tbody>
            </table>

            {{ $processos->links() }}


        </div>

    </div>

</div>


@endsection

