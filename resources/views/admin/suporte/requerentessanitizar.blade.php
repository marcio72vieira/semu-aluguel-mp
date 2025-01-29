@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">SANITIZAR -  LIMPAR ESPAÇO EM DISCO </h2>
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
                        <th>Status</th>
                        <th>Data de Criação</th>
                        <th><span style="margin-left: 15px">Tempo armazenado</span></th>
                        <th width="8%">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($requerentes as $requerente)
                        <tr>
                            <td>{{ $requerente->id }}</th>
                            <td>{{ $requerente->nomecompleto }}</th>
                            <td>
                                @if($requerente->estatus == 1) <span style="font-size: 14px" title="Falta enviar os documentos exigidos para análise!"> <i class="fa-solid fa-shoe-prints"></i> em andamento </span> @endif
                                @if($requerente->estatus == 2) <span style="font-size: 14px" title="Aguardando ser analisado!"> <i class="fa-solid fa-user-check"></i> em análise  </span> @endif
                                @if($requerente->estatus == 3) <span style="font-size: 14px" title="Foram detectadas inconsistências nos documentos enviados!"> <i class="fa-solid fa-clock-rotate-left"></i> com pendência  </span> @endif
                                @if($requerente->estatus == 4) <span style="font-size: 14px" title="Os documentos inconsistentes foram substituidos!"> <i class="fa-solid fa-check-double"></i> corrigidos para reanálise </span> @endif
                                @if($requerente->estatus == 5) <span style="font-size: 14px" title="Processo gerado com sucesso!"> <i class="fa-regular fa-circle-check"></i> concluído  </span> @endif
                            </td>
                            <td>{{  \Carbon\Carbon::parse($requerente->created_at)->format('d/m/Y') }}</td>
                            <td>{{  mrc_calc_time(\Carbon\Carbon::parse($requerente->created_at)->format('Y/m/d')) }}</td>
                            <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch">
                                {{-- Exibe a modal com os documentos que já foram anexados para guiar o assistente social --}}
                                <a href=""  data-bs-toggle="modal" data-bs-target="#modalFormMudaEstatus{{ $requerente->id }}"  class="mb-3 btn btn-primary btn-sm me-1" title="Visualizar os dados cadastrados">
                                    <i class="fa-solid fa-database"></i> Limpar disco
                                </a>


                                {{-- inicio modal --}}
                                {{-- MODAL modalFormMudaEstatus OBS: O id da modal para cada registro tem que ser diferente, por isso a necessidade de concatenr com o id da requerente --}}
                                <div class="modal fade" id="modalFormMudaEstatus{{ $requerente->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5" id="exampleModalLabel">ALTERAR ESTATUS</h2>
                                            </div>

                                            <div class="modal-body">
                                                <!-- Passando o id da empresa atual($nutricionista->empresa->id) para após o remanejamento ser efetivado, o usuário ser redirecionado para essa mesma página -->
                                                <form action="{{ route('suporte.updatemudarestatus', ['requerente' => $requerente->id]) }}" method="POST" style="display: inline">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">
                                                        Requerente:
                                                        <h5>{{$requerente->nomecompleto}}</h5>
                                                        <br>
                                                        Status Atual
                                                        <h5>
                                                            {{ ($requerente->estatus == '1' ? "EM ANDAMENTO" : ($requerente->estatus == '2' ? "EM ANÁLISE" : ($requerente->estatus == '3' ? "COM PENDÊNCIA" : ($requerente->estatus == '4' ? "CORRIGIDO" : "CONCLUÍDO")))) }}
                                                        </h5>
                                                        <br>
                                                        Alterar para Status:
                                                        <div class="form-group focused">
                                                            <select name="novoestatus" id="novoestatus" class="form-control">
                                                                <option value="" selected disabled>Escolha ...</option>
                                                                <option value="1">em andamento</option>
                                                                <option value="2">para análise</option>
                                                                <option value="3">pendente</option>
                                                                <option value="4">corrigido</option>
                                                                {{-- <option value="5">concluído</option> --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger" role="button"> Confirmar</button>
                                                    </div>
                                                </form>
                                            </div>

                                            {{-- <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                {{-- fim modal --}}
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhuma Requerente com status em condições de ser alterada foi encontrada!</div>
                    @endforelse
                </tbody>
            </table>

            {{ $requerentes->links() }}


        </div>

    </div>

</div>

@endsection

