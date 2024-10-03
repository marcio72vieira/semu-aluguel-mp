@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">UNIDADE DE ATENDIMENTO -  edição</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Unidades de Atendimentos</a></li>
                <li class="breadcrumb-item active">Unidade de Atendimento</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small text-danger p-2"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
                <x-errorexception />

                <form action="{{ route('unidadeatendimento.update', ['unidadeatendimento' => $unidadeatendimento->id]) }}" method="POST" autocomplete="off">
                    @csrf,
                    @method('PUT')

                    {{-- tipounidade_id --}}
                    <div class="mb-4 row">
                        <label for="tipounidade_id" class="col-sm-2 col-form-label">Tipo de Unidade <span class="small text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="tipounidade_id" id="tipounidade_id" class="form-control" >
                                <option value="" selected disabled>Escolha...</option>
                                @foreach($tiposunidades as $tipounidade)
                                    <option value="{{ $tipounidade->id }}" {{ old('tipounidade_id', $unidadeatendimento->tipounidade->id) == $tipounidade->id ? 'selected' : '' }}>{{ $tipounidade->nome }}</option>
                                @endforeach
                            </select>
                            @error('tipounidade_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- nome --}}
                    <div class="mb-4 row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="nome" value="{{ old('nome', $unidadeatendimento->nome) }}" class="form-control" id="nome" placeholder="Nome da Unidade" >
                          @error('nome')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>

                    {{-- endereco --}}
                    <div class="mb-4 row">
                        <label for="endereco" class="col-sm-2 col-form-label">Endereço <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="endereco" value="{{ old('endereco', $unidadeatendimento->endereco) }}" class="form-control" id="endereco" placeholder="Rua, Av. Trav, etc.." >
                            @error('endereco')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- numero --}}
                    <div class="mb-4 row">
                        <label for="numero" class="col-sm-2 col-form-label">Número <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="numero" value="{{ old('numero', $unidadeatendimento->numero) }}" class="form-control" id="numero" placeholder="Número" >
                            @error('numero')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- complemento --}}
                    <div class="mb-4 row">
                        <label for="complemento" class="col-sm-2 col-form-label">Complemento</label>
                        <div class="col-sm-10">
                            <input type="text" name="complemento" value="{{ old('complemento', $unidadeatendimento->complemento) }}" class="form-control" id="complemento" placeholder="Complemento" >
                        </div>
                    </div>

                    {{-- bairro --}}
                    <div class="mb-4 row">
                        <label for="bairro" class="col-sm-2 col-form-label">Bairro <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="bairro" value="{{ old('bairro', $unidadeatendimento->bairro) }}" class="form-control" id="bairro" placeholder="Bairro" >
                            @error('bairro')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- cep --}}
                    <div class="mb-4 row">
                        <label for="cep" class="col-sm-2 col-form-label">CEP <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="cep" value="{{ old('cep', $unidadeatendimento->cep) }}" class="form-control" id="cep" placeholder="CEP" >
                            @error('cep')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- fone --}}
                    <div class="mb-4 row">
                        <label for="fone" class="col-sm-2 col-form-label">Telefone <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="fone" value="{{ old('fone', $unidadeatendimento->fone) }}" class="form-control mask-cell" id="fone" placeholder="Telefone" >
                            @error('fone')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- municipio --}}
                    <div class="mb-4 row">
                        <label for="municipio_id" class="col-sm-2 col-form-label">Município <span class="small text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="municipio_id" id="municipio_id" class="form-control select2" >
                                <option value="" selected disabled>Escolha...</option>
                                @foreach($municipios as $municipio)
                                    <option value="{{ $municipio->id }}" {{ old('municipio_id', $unidadeatendimento->municipio->id) == $municipio->id ? 'selected' : '' }}>{{ $municipio->nome }}</option>
                                @endforeach
                            </select>
                            @error('municipio_id')
                                <small style="color: red">{{$message}}</small>
                                @error('municpio_id')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                            @enderror
                        </div>
                    </div>

                    {{-- ativo --}}
                    <div class="mb-4 row">
                        <label for="ativosim" class="col-sm-2 col-form-label">Ativo ? <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ativo" id="ativosim" value="1" {{old('ativo', $unidadeatendimento->ativo) == '1' ? 'checked' : ''}} reuired>
                                    <label class="form-check-label" for="ativosim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ativo" id="ativonao" value="0" {{old('ativo', $unidadeatendimento->ativo) == '0' ? 'checked' : ''}} >
                                    <label class="form-check-label" for="ativonao">Não</label>
                                </div>
                                <br>
                                @error('ativo')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <div style="margin-top: 15px">
                                <a class="btn btn-outline-secondary" href="{{ route('unidadeatendimento.index')}}" role="button">Cancelar</a>
                                <button type="submit" class="btn btn-primary" style="width: 95px;"> Salvar </button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection