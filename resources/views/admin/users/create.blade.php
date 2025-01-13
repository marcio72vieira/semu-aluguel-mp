@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">USUÁRIO -  cadastro</h2>
            {{-- <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Usuários</a></li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol> --}}
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small text-danger p-2"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
                <x-errorexception />

                <form action="{{ route('user.store') }}" method="POST" autocomplete="off">
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
                        <label for="nome" class="col-sm-2 col-form-label">Usuário <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="nome" value="{{ old('nome') }}" class="form-control" id="nome" placeholder="Nome de usuário" >
                          @error('nome')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- cpf --}}
                    <div class="mb-4 row">
                        <label for="cpf" class="col-sm-2 col-form-label">CPF <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" name="cpf" value="{{ old('cpf') }}" class="form-control cpf" id="cpf" placeholder="CPF (só números)" >
                          @error('cpf')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- municipio --}}
                    <div class="mb-4 row">
                        <label for="municipio_id" class="col-sm-2 col-form-label">Município <span class="small text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="municipio_id" id="municipio_id" class="form-control select2">
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
                            <select name="unidadeatendimento_id" id="unidadeatendimento_id" class="form-control select2">
                                <option value="" selected disabled>Escolha...</option>
                                @foreach($unidadesatendimentos  as $unidadeatendimento)
                                    {{--
                                        Só exibe as unidadesdeatendimentos cujo valor da propriedade municipio_id do objeto unidadeatendmento for igual ao valor do municipio_id  selecionado  anteriormente
                                        [old('municipio_id')] ao submeter o formulário. Depois, testa se a unidadeatendimento_id postada [old('unidadeatendimento_id') == $unidadeatendimento->id] é igual ao
                                        valor da unidadeatendimento atual para selecioná-la com selected
                                    --}}
                                    @if($unidadeatendimento->municipio_id == old('municipio_id'))
                                        <option value="{{$unidadeatendimento->id}}" {{old('unidadeatendimento_id') == $unidadeatendimento->id ? 'selected' : ''}}>{{$unidadeatendimento->nome}}</option>
                                    @endif
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
                          <input type="text" name="fone" value="{{ old('fone') }}" class="form-control  mask-cell" id="fone" placeholder="Telefone (só números)" >
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
                                <option value="adm" {{old('perfil') == 'adm' ? 'selected' : ''}}>Administrador</option>
                                <option value="srv" {{old('perfil') == 'srv' ? 'selected' : ''}}>Analista</option>
                                <option value="ass" {{old('perfil') == 'ass' ? 'selected' : ''}}>Operador</option>
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
                          <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Senha" >
                          @error('password')
                              <small style="color: red">{{$message}}</small>
                          @enderror
                        </div>
                    </div>


                    {{-- password_confirmation --}}
                    <div class="mb-4 row">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar Senha <span class="small text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="password_confirmation" placeholder="Confirme a senha" >
                          @error('password_confirmation')
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
                                <a class="btn btn-outline-secondary" href="{{ route('user.index')}}" role="button">Cancelar</a>
                                <button type="submit" class="btn btn-primary" style="width: 95px;"> Salvar </button>
                            </div>
                        </div>
                    </div>

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
                    url:"{{ route('getunidadesatendimentomunicipio') }}",
                    type: "GET",
                    data: {
                        municipio_id: municipio_id,
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#unidadeatendimento_id').html('<option value="">Escolha...</option>');
                        $.each(result.unidadesatendimento,function(key,value){
                            $("#unidadeatendimento_id").append('<option value="'+ value.id +'">'+ value.nome +'</option>');
                        });
                    }
                });
            });

    </script>

@endsection
