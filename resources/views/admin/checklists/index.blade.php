@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">CHECK LIST - REQUERENTES</h2>
        {{-- <ol class="mt-3 mb-3 breadcrumb ms-auto">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="">Requerentes</a></li>
        </ol> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="gap-2 card-header hstack">
            <span class="flex-row mt-1 mb-1 ms-auto d-sm-flex">
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
                        <th>Tipo</th>
                        <th>Unidade Atendimento</th>
                        <th>Assitente Social</th>
                        <th>Telefones</th>
                        <th>Servidor SEMU</th>
                        <th>Status</th>
                        <th width="200px">Ação</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Acessando propriedades diretamente sem foreach--}}
                    {{-- @dd("Acessando a collection requerentes", $requerentes[0]) --}}
                    {{-- @dd("Acessando a propriedade nomecompleto de requerentes", $requerentes[0]['nomecompleto']) --}}
                    {{-- @dd("Acessando um relacionamento de requerentes", $requerentes[0]['documentos']) --}}
                    {{-- @dd("Acessando uma propriedade de um dos relacionamento de requerentes", $requerentes[0]['documentos'][0]['url']) --}}
                    {{-- @dd("Acessando uma propriedade de um dos relacionamento de requerentes", $requerentes[0]['documentos'][0]['user_id']) --}}
                    {{-- @dd("Acessando a propriedade nome do relacionamento regional de requernete", $requerentes[0]['regional']['nome']) --}}
                    
                   

                    @forelse ($requerentes as $requerente)
                        <tr>
                            <td>{{ $requerente->id }}</td>
                            <td>{{ $requerente->nomecompleto }}</td>
                            <td>{{ $requerente->municipio->nome }}</td>
                            <td>{{ $requerente->tipounidade->nome }}</td>
                            <td>{{ $requerente->unidadeatendimento->nome }}</td>
                            <td>{{ $requerente->user->nome }}</td>
                            <td>{{ $requerente->foneresidencial }} <br> {{ $requerente->fonecelular }} </td>
                            <td> 
                                {{-- $requerente->servidorResponsavelPelaAnaliseDocumentos(3)[0]->nomecompleto --}}
                                {{-- @foreach ($requerente->documentos as $documento) {{ $documento->user->nomecompleto }} @if ($loop->first) @break @endif @endforeach --}}
                                
                                @foreach ($requerente->documentos as $documento)
                                    {{-- No momento do cadastro dos documentos o usuário(user_id) que será cadastrado na tabela "documentos", é o usuário(user_id)
                                         do Assistente Social, responsável pelo cadastro  da Requerente. Só quando  for feita a análise  dos documentos  é  que  o
                                         (user_id) do Servidor da Semu irá  substituir o (user_id) do Assistente Social na tabela "documentos". Enquanto a análise
                                         não for concluída, irá aparecer  as "reticẽncias", indicando que os documentos  da Requerente ainda não foram analisados.
                                         Seria um erro exibir o nome do Assistente Social como sendo o Nome do Servidor da SEMU. --}} 
                                    @if ($documento->user->nome == $requerente->user->nome)
                                        <i class="fa-solid fa-ellipsis" title="documentos sendo anexados..."></i>
                                    @else
                                        {{ $documento->user->nome }}
                                    @endif
                                    @if ($loop->first) @break @endif 
                                @endforeach
                            </td>
                            <td>
                                @if($requerente->status == 1) <span style="font-size: 14px;"> <i class="fa-solid fa-shoe-prints"></i> em andamento </span> @endif  {{-- falta anexar todos os documentos --}}
                                @if($requerente->status == 2) <span style="font-size: 14px;"> <i class="fa-solid fa-user-check"></i> para análise  </span> @endif    {{-- os documentos foram enviados para análise depois de anexar os documentos --}}
                                @if($requerente->status == 3) <span style="font-size: 14px;"> <i class="fa-solid fa-clock-rotate-left"></i> pendente  </span> @endif {{-- falta anexar documents --}}
                                @if($requerente->status == 4) <span style="font-size: 14px;"> <i class="fa-solid fa-check-double"></i> corrigido  </span> @endif {{-- Os documentos inconsistentes foram substituidos --}}
                                @if($requerente->status == 5) <span style="font-size: 14px;"> <i class="fa-regular fa-circle-check"></i> concluído  </span> @endif {{-- O check list foi feito e o processo foi gerado --}}
                            </td>
                            <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch">
                                @if($requerente->status != 1 && $requerente->status != 3 && $requerente->status != 5)
                                    <a href="{{ route('documento.index', ['requerente' => $requerente->id]) }}" class="mb-3 btn btn-warning btn-sm me-1">
                                        <i class="fa-solid fa-list-check"></i> Analisar documentos
                                    </a>
                                @else
                                    <button type="button"  class="mb-3 btn btn-outline-secondary btn-sm me-1"> <i class="fa-solid fa-ban"></i> Analisar documentos </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhuma Requerente a ser analisada foi encontrada!</div>
                    @endforelse
                </tbody>
            </table>

            {{ $requerentes->links() }}


        </div>

    </div>

</div>


@endsection

