@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">EXCLUIR DOCUMENTOS</h2>
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="gap-2 card-header hstack">
            <span class="flex-row mt-1 mb-1 ms-auto d-sm-flex">
                {{-- <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fa-regular fa-square-plus"></i> Cadastrar </a> --}}
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
                        <th class="d-none d-md-table-cell">Quantidade</th>
                        <th class="d-none d-md-table-cell">Status</th>
                        <th width="8%">Ações</th>
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
                            <td><span style="margin-left: 30px;">{{ $requerente->docsAnexados($requerente->id) }}</span></td>
                            <td>
                                @if($requerente->estatus == 1) <span style="font-size: 14px" title="Falta enviar os documentos exigidos para análise!"> <i class="fa-solid fa-shoe-prints"></i> em andamento </span> @endif
                                @if($requerente->estatus == 2) <span style="font-size: 14px" title="Aguardando ser analisado!"> <i class="fa-solid fa-user-check"></i> em análise  </span> @endif
                                @if($requerente->estatus == 3) <span style="font-size: 14px" title="Foram detectadas inconsistências nos documentos enviados!"> <i class="fa-solid fa-clock-rotate-left"></i> com pendência  </span> @endif
                                @if($requerente->estatus == 4) <span style="font-size: 14px" title="Os documentos inconsistentes foram substituidos!"> <i class="fa-solid fa-check-double"></i> corrigidos para reanálise </span> @endif
                                @if($requerente->estatus == 5) <span style="font-size: 14px" title="Processo gerado com sucesso!"> <i class="fa-regular fa-circle-check"></i> concluído  </span> @endif
                            </td>
                            <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch">
                                <a href="{{ route('suporte.listardocumentosrequerente', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-primary btn-sm me-1" title="Listar documentos">
                                    <i class="fa-solid fa-folder-tree"></i> Documentos
                                </a>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhuma Requerente com documentos para exclusão!</div>
                    @endforelse
                </tbody>
            </table>

            {{ $requerentes->links() }}

        </div>

    </div>

</div>

@endsection

