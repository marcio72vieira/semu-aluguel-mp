@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Cadastrar Unidades de Atendimentos</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Unidade de Atendimento</a></li>
                <li class="breadcrumb-item active">Unidade de Atendimento</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small text-danger"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                {{-- <x-alert /> --}}

                <form action="{{ route('unidadeatendimento.store') }}" method="POST" autocomplete="off">
                    @csrf
                    @method('POST')

                    <div class="mb-4 row">
                        <label for="tipounidade_id" class="col-sm-2 col-form-label">Tipo de Unidade <span class="small text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="tipounidade_id" id="tipounidade_id" class="form-control" required>
                                <option value="" selected disabled>Escolha...</option>
                                @foreach($tiposunidades as $tipounidade)
                                    <option value="{{ $tipounidade->id }}" {{ old('tipounidade_id') == $tipounidade->id ? 'selected' : '' }}>{{ $tipounidade->nome }}</option>
                                @endforeach
                            </select>
                            @error('tipounidade_id')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome da Unidade" required>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="endereco" class="col-sm-2 col-form-label">Endereço <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="endereco" class="form-control" id="endereco" placeholder="Rua, Av. Trav, etc.." required>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="numero" class="col-sm-2 col-form-label">Número <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="numero" class="form-control" id="numero" placeholder="Número" required>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="complemento" class="col-sm-2 col-form-label">Complemento</label>
                        <div class="col-sm-10">
                            <input type="text" name="complemento" class="form-control" id="complemento" placeholder="Complemento" required>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="bairro" class="col-sm-2 col-form-label">Bairro <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro" required>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="cep" class="col-sm-2 col-form-label">CEP <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="cep" class="form-control" id="cep" placeholder="CEP" required>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="fone" class="col-sm-2 col-form-label">Telefone <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="fone" class="form-control" id="fone" placeholder="Telefone" required>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="municipio_id" class="col-sm-2 col-form-label">Município <span class="small text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="municipio_id" id="municipio_id" class="form-control" required>
                                <option value="" selected disabled>Escolha...</option>
                                @foreach($municipios as $municipio)
                                    <option value="{{ $municipio->id }}" {{ old('municipio_id') == $municipio->id ? 'selected' : '' }}>{{ $municipio->nome }}</option>
                                @endforeach
                            </select>
                            @error('municipio_id')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="fone" class="col-sm-2 col-form-label">Ativo ? <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ativo" id="ativosim" value="1" {{old('ativo') == '1' ? 'checked' : ''}} reuired>
                                <label class="form-check-label" for="ativosim">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ativo" id="ativonao" value="0" {{old('ativo') == '0' ? 'checked' : ''}} required>
                                <label class="form-check-label" for="ativonao">Não</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="fone" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <div style="margin-top: 15px">
                                <a class="btn btn-primary" href="{{ route('unidadeatendimento.index')}}" role="button">Cancelar</a>
                                <button type="submit" class="btn btn-primary" style="width: 95px;"> Salvar </button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
