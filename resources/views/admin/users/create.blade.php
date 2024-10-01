@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">USUÁRIO -  cadastro</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Usuários</a></li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small text-danger p-2"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                {{-- <x-alert /> --}}

                <form action="{{ route('unidadeatendimento.store') }}" method="POST" autocomplete="off">
                    @csrf
                    @method('POST')

                    {{-- nomecompleto --}}
                    <div class="mb-4 row">
                        <label for="nomecompleto" class="col-sm-2 col-form-label">Nome Completo <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="nomecompleto" value="{{ old('nomecompleto') }}" class="form-control" id="nomecompleto" placeholder="Nome completo" >
                          @error('nomecompleto')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- nome --}}
                    <div class="mb-4 row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="nome" value="{{ old('nome') }}" class="form-control" id="nome" placeholder="Nome da Unidade" >
                          @error('nome')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- cpf --}}
                    <div class="mb-4 row">
                        <label for="cpf" class="col-sm-2 col-form-label">CPF <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="cpf" value="{{ old('cpf') }}" class="form-control" id="cpf" placeholder="CPF (só números)" >
                          @error('cpf')
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
                                    <option value="{{ $municipio->id }}" {{ old('municipio_id') == $municipio->id ? 'selected' : '' }}>{{ $municipio->nome }}</option>
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


                    {{-- unidadeatendimento_id --}}
                    <div class="mb-4 row">
                        <label for="unidadeatendimento_id" class="col-sm-2 col-form-label">Unidade de Atendimento <span class="small text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="unidadeatendimento_id" id="unidadeatendimento_id" class="form-control" >
                                <option value="" selected disabled>Escolha...</option>
                                @foreach($unidadesatendimentos as $unidadeatendimento)
                                    <option value="{{ $unidadeatendimento->id }}" {{ old('unidadeatendimento_id') == $unidadeatendimento->id ? 'selected' : '' }}>{{ $unidadeatendimento->nome }}</option>
                                @endforeach
                            </select>
                            @error('unidadeatendimento_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    {{-- cargo --}}
                    <div class="mb-4 row">
                        <label for="cargo" class="col-sm-2 col-form-label">Cargo <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="cargo" value="{{ old('cargo') }}" class="form-control" id="cargo" placeholder="Digite o cargo" >
                          @error('cargo')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- fone --}}
                    <div class="mb-4 row">
                        <label for="fone" class="col-sm-2 col-form-label">Telefone <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="fone" value="{{ old('fone') }}" class="form-control" id="fone" placeholder="Telefone (só números)" >
                          @error('fone')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- perfil --}}
                    <div class="mb-4 row">
                        <label for="perfil" class="col-sm-2 col-form-label">Perfil <span class="small text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="perfil" id="perfil" class="form-control" >
                                <option value="" selected disabled>Escolha...</option>
                                <option value="adm">Administrador</option>
                                <option value="srv">Servidor</option>
                                <option value="ass">Assistente Social</option>
                                
                            </select>
                            @error('perfil')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    {{-- email --}}
                    <div class="mb-4 row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Melhor e-mail" >
                          @error('email')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- password --}}
                    <div class="mb-4 row">
                        <label for="password" class="col-sm-2 col-form-label">Senha <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Senha" >
                          @error('password')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- confirmarsenha --}}
                    <div class="mb-4 row">
                        <label for="confirmarsenha" class="col-sm-2 col-form-label">Confirmar Senha <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="confirmarsenha" value="{{ old('confirmarsenha') }}" class="form-control" id="confirmarsenha" placeholder="Confirme a senha" >
                          @error('confirmarsenha')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>

                    {{-- ativo --}}
                    <div class="mb-4 row">
                        <label for="ativosim" class="col-sm-2 col-form-label">Ativo ? <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ativo" id="ativosim" value="1" {{old('ativo') == '1' ? 'checked' : ''}} reuired>
                                    <label class="form-check-label" for="ativosim">Sim</label>
                                    
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ativo" id="ativonao" value="0" {{old('ativo') == '0' ? 'checked' : ''}} >
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


                    {{-- 
                    endereco 
                    <div class="mb-4 row">
                        <label for="endereco" class="col-sm-2 col-form-label">Endereço <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="endereco" value="{{ old('endereco') }}" class="form-control" id="endereco" placeholder="Rua, Av. Trav, etc.." >
                            @error('endereco')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    numero 
                    <div class="mb-4 row">
                        <label for="numero" class="col-sm-2 col-form-label">Número <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="numero" value="{{ old('numero') }}" class="form-control" id="numero" placeholder="Número" >
                            @error('numero')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    complemento 
                    <div class="mb-4 row">
                        <label for="complemento" class="col-sm-2 col-form-label">Complemento</label>
                        <div class="col-sm-10">
                            <input type="text" name="complemento" value="{{ old('complemento') }}" class="form-control" id="complemento" placeholder="Complemento" >
                        </div>
                    </div>

                    bairro 
                    <div class="mb-4 row">
                        <label for="bairro" class="col-sm-2 col-form-label">Bairro <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="bairro" value="{{ old('bairro') }}" class="form-control" id="bairro" placeholder="Bairro" >
                            @error('bairro')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    cep 
                    <div class="mb-4 row">
                        <label for="cep" class="col-sm-2 col-form-label">CEP <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="cep" value="{{ old('cep') }}" class="form-control" id="cep" placeholder="CEP" >
                            @error('cep')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    fone 
                    <div class="mb-4 row">
                        <label for="fone" class="col-sm-2 col-form-label">Telefone <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="fone" value="{{ old('fone') }}" class="form-control mask-cell" id="fone" placeholder="Telefone" >
                            @error('fone')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    --}}

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //Recuperação dinâmica das Unidades de Atendimento de um Município
        $('#municipio_id').on('change', function() {
                var municipio_id = this.value;
                $("#unidadeatendimento_id").html('');
                $.ajax({
                    url:"{{route('getunidadesatendimentomunicipio')}}",
                    type: "GET",
                    data: {
                        municipio_id: municipio_id,
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#unidadeatendimento_id').html('<option value="">Escolha...</option>');
                        $.each(result.unidadesatendimento,function(key,value){
                            $("#unidadeatendimento_id").append('<option value="'+value.id+'">'+value.nome+'</option>');
                        });
                    }
                });
            });

    </script>
    
@endsection
