@extends('layout.admin')

@section('content')
<div class="px-4 container-fluid">
    <div class="gap-2 mb-1 hstack">
        <h2 class="mt-3">Check List</h2>
        {{--
        <span class="flex-row mt-1 mt-3 mb-1 ms-auto d-sm-flex">
            <a href="{{ route('requerente.create') }}" class="btn btn-success btn-sm me-1"><i class="fas fa-upload"></i> Adicionar </a>
        </span>
        --}}
    </div>

    <div class="mb-4 shadow card border-light">
        <div class="gap-2 card-header hstack">

            <span class="p-2 small"><strong> Requerente: {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} </strong></span>
            {{--
            <span class="flex-row mt-1 mb-1 ms-auto d-sm-flex">
                <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index')}}" role="button">Cancelar</a>
                <a class="btn btn-danger me-1" href="{{ route('documento.merge', ['requerente' => $requerente->id]) }}"><i class="fa-solid fa-layer-group"></i> Processar Documentos </a>
            </span>
            --}}
        </div>

        <div class="card-body">

            {{-- @dd($documentos) --}}

            <x-alert />

            {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
            <x-errorexception />
            <form action="{{ route('documento.update') }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Documento</th>
                            <th>Visualizar</th>
                            <th style="padding-left: 40px">Aprovado{{-- Confere --}}</th>
                            <th>Observação</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($documentos as $documento)
                            <tr>
                                <td>{{ $documento->id }}</th>
                                <td>{{ $documento->tipodocumento->nome }}</th>
                                <td> <a href="{{ asset('/storage/'.$documento->url) }}" target="_blank"> <img src="{{ asset('images/icopdf3.png') }}" width="30" style="margin-left: 25px;"> </a></td>
                                <td>
                                    <div style="margin-top: 7px">
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="aprovado-{{ $documento->id }}" id="aprovado-{{ $documento->id }}sim" value="1"  required>
                                                <label class="form-check-label" for="aprovado-{{ $documento->id }}sim">sim</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="aprovado-{{ $documento->id }}" id="aprovado-{{ $documento->id }}nao" value="0" required>
                                                <label class="form-check-label" for="aprovado-{{ $documento->id }}nao">não</label>
                                            </div>
                                        <br>
                                        @error('aprovado-{{ $documento->id }}')
                                            <small style="color: red">{{$message}}</small>
                                        @enderror
                                        </div>
                                    </div>
                                </td>
                                <td>
                                {{-- observacao --}}
                                    <div class="form-group focused">
                                        <textarea class="form-control" name="observacao-{{ $documento->id}}" id="observacao-{{ $documento->id}}" rows="2"></textarea>
                                        @error('observacao-{{ $documento->id}}')
                                            <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum documento encontrado! </div>
                        @endforelse
                    </tbody>
                </table>

                <!-- Buttons -->
                <div class="flex-row col-12 d-md-flex justify-content-end">
                    <div style="margin-top: 25px">
                        {{-- <a class="btn btn-outline-secondary me-2" href="{{ url()->previous() }}" role="button">Cancelar</a> --}}
                        <a class="btn btn-outline-secondary me-2" href="{{ route('requerente.index') }}" role="button">Cancelar</a>
                        <button type="submit" class="btn btn-primary me-4" style="width: 95px;"> Anexar </button>

                        {{--
                        Este campo só dever ser mostrado se não houver pendências (aprovado = não)
                        Quando submeter para análise, o campo pendente(status) na tabela requerente deverá ser atualizado para "em análise e nada mais poderá ser feito em relação ao requerente, ou seja, nem cadastrar, nem editar, nem apagar"
                        --}}
                        <a class="btn btn-danger me-1" href="{{ route('documento.merge', ['requerente' => $requerente->id]) }}"><i class="fa-solid fa-layer-group"></i> Mesclar </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

