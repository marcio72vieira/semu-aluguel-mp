@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Editar Tipo de Documento</h2>
            {{-- <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Tipos de Unidade</a></li>
                <li class="breadcrumb-item active">Tipo de Unidade</li>
            </ol> --}}
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small text-danger p-3"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                {{-- <x-alert /> --}}

                <form action="{{ route('tipodocumento.update', ['tipodocumento' => $tipodocumento->id]) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Nome --}}
                        <div class="col-5">
                            <div class="form-group focused">
                                <label class="form-control-label" for="nome">Nome<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $tipodocumento->nome) }}" placeholder="Nome do Documento" required >
                                @error('nome')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- ordem --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="ordem">Ordem<span class="small text-danger">*</span></label>
                                <input type="number"  min="1" max="20" class="form-control" id="ordem" name="ordem" value="{{ old('ordem', $tipodocumento->ordem) }}" placeholder="Ordem do Documento" required >
                                @error('ordem')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>


                        {{-- ativo --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="ativo">Ativo ? <span class="small text-danger">*</span></label>
                                <div style="margin-top: 7px">
                                    <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ativo" id="ativosim" value="1" {{old('ativo', $tipodocumento->ativo) == '1' ? 'checked' : ''}} >
                                        <label class="form-check-label" for="ativosim">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ativo" id="ativonao" value="0" {{old('ativo', $tipodocumento->ativo) == '0' ? 'checked' : ''}} >
                                        <label class="form-check-label" for="ativonao">Não</label>
                                    </div>
                                    <br>
                                    @error('ativo')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-3 flex-row d-md-flex justify-content-end">
                                <div style="margin-top: 15px">
                                    <a class="btn btn-outline-secondary" href="{{ route('tipodocumento.index')}}" role="button">Cancelar</a>
                                    <button type="submit" class="btn btn-primary" style="width: 95px;"> Salvar </button>
                                </div>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
