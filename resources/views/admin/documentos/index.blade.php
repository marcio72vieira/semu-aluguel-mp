@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">Check List - Documentos - {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} </h2>
        {{-- <span class="flex-row mt-1 mt-3 mb-1 ms-auto d-sm-flex">
            <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fas fa-upload"></i> Adicionar </a>
        </span> --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="gap-2 card-header hstack">

            <span class="p-2 small"><strong> DOCUMENTAÇÃO NECESSÁRIA PARA ABERTURA DE PROCESSO DO ALUGUEL SOCIAL MARIA DA PENHA </strong></span>

            <span class="flex-row mt-1 mb-1 ms-auto d-sm-flex">
                <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index')}}" role="button">Cancelar</a>
                <a class="btn btn-success me-1" href="{{ route('documento.create', ['requerente' => $requerente->id]) }}"><i class="fas fa-upload"></i> Adicionar </a>
                <a class="btn btn-danger me-1" href="{{ route('documento.merge', ['requerente' => $requerente->id]) }}"><i class="fa-solid fa-layer-group"></i> Agrupar Documentos </a>
            </span>
        </div>

        <div class="card-body">

            {{-- @dd($documentos) --}}

            <x-alert />

            {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
            <x-errorexception />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Documento</th>
                        <th>Confere</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($documentos as $documento)
                        <tr>
                            <td>{{ $documento->id }}</th>
                            <td>{{ $documento->tipodocumento->nome }}</th>
                            <td> <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank"> <img src="{{ asset('images/icopdf.png') }}" width="20"> </a></td>
                            <td class="flex-row flex-wrap d-md-flex justify-content-start align-content-stretch" style="width=100px">
                                {{-- checklist --}}
                                <div class="col-3">
                                        <div style="margin-top: 7px">
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="ativo" id="ativosim" value="1"  required>
                                                    <label class="form-check-label" for="ativosim">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="ativo" id="ativonao" value="0" required>
                                                    <label class="form-check-label" for="ativonao">Não</label>
                                                </div>
                                            <br>
                                            @error('ativo')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                            </div>
                                        </div>
                                    
                                </div>
                                {{-- <form id="formDelete{{ $documento->id }}" method="POST" action="{{ route('documento.destroy', ['documento' => $documento->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm btnDelete" data-delete-entidade="Documento" data-delete-id="{{ $documento->id }}"  data-value-record="{{ $documento->tipodocumento->nome }}">
                                        <i class="fa-regular fa-trash-can"></i> Excluir
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger" role="alert">Nenhum documento encontrado! </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

