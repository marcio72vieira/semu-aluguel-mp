@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">REQUERENTE -  cadastro</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Requerentes</a></li>
                <li class="breadcrumb-item active">Requerente</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small text-danger p-2"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
                <x-errorexception />

                <form action="{{ route('requerente.store') }}" method="POST" autocomplete="off" id="formcadastrorequerente">
                    @csrf
                    @method('POST')

                    <div class="row mb-3">

                        {{-- Nomecompleto --}}
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="nomecompleto">Nome <span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="nomecompleto" name="nomecompleto" value="{{old('nomecompleto')}}">
                                @error('nomecompleto')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- sexobiologico --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="sexobiologicofem">Sexo Biológico <span class="small text-danger">*</span></label>
                                <div style="margin-top: 10px">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexobiologico" id="sexobiologicomas" value="masculino" {{old('sexobiologico') == 'masculino' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="sexobiologicomas">Mas</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexobiologico" id="sexobiologicofem" value="feminino" {{old('sexobiologico') == 'feminino' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="sexobiologicofem">Fem</label>
                                    </div>
                                    <br>
                                    @error('sexobiologico')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- rg --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="rg">RG<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="rg" name="rg" value="{{old('rg')}}">
                                @error('rg')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- orgaoexpedidor --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="orgaoexpedidor">Órgão Expedidor<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="orgaoexpedidor" name="orgaoexpedidor" value="{{old('orgaoexpedidor')}}">
                                @error('orgaoexpedidor')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- cpf --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="cpf">CPF<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{{old('cpf')}}">
                                @error('cpf')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>



                    <div class="row mb-3">
                        {{-- banco --}}
                        <div class="col-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="banco">Banco <span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="banco" name="banco" value="{{old('banco')}}">
                                @error('banco')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- agencia --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="agencia">Agência<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="agencia" name="agencia" value="{{old('agencia')}}" >
                                @error('agencia')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- conta --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="conta">Conta<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="conta" name="conta" value="{{old('conta')}}" >
                                @error('conta')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>


                        {{-- contaespecifica --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="contaespecificasim">Conta específica (com movimento)<span class="small text-danger">*</span></label>
                                <div style="margin-top: 10px">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contaespecifica" id="contaespecificasim" value="1" {{old('contaespecifica') == '1' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="contaespecificasim">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contaespecifica" id="contaespecificanao" value="0" {{old('contaespecifica') == '0' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="contaespecificanao">Não</label>
                                    </div>
                                    <br>
                                    @error('contaespecifica')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row mb-3">
                        {{-- comunidade --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <label class="form-control-label" for="comunidade">Comunidade especifica/tradicional<span class="small text-danger">*</span></label>
                                <select name="comunidade" id="comunidade" class="form-control">
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{old('comunidade') == '1' ? 'selected' : ''}}>Cigano</option>
                                    <option value="2" {{old('comunidade') == '2' ? 'selected' : ''}}>Quilombola</option>
                                    <option value="3" {{old('comunidade') == '3' ? 'selected' : ''}}>Matriz Africana</option>
                                    <option value="4" {{old('comunidade') == '4' ? 'selected' : ''}}>Indígena</option>
                                    <option value="5" {{old('comunidade') == '5' ? 'selected' : ''}}>Assentado / acampado</option>
                                    <option value="6" {{old('comunidade') == '6' ? 'selected' : ''}}>Pessoa do campo / floresta</option>
                                    <option value="7" {{old('comunidade') == '7' ? 'selected' : ''}}>Pessoa em situação de rua</option>
                                    <option value="20" {{old('comunidade') == '20' ? 'selected' : ''}}>Outra</option>
                                </select>
                                @error('comunidade')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>


                        {{-- racacor --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <label class="form-control-label" for="racacor">Cor / Raça<span class="small text-danger">*</span></label>
                                <select name="racacor" id="racacor" class="form-control" >
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{old('racacor') == '1' ? 'selected' : ''}}>Branca</option>
                                    <option value="2" {{old('racacor') == '2' ? 'selected' : ''}}>Preta</option>
                                    <option value="3" {{old('racacor') == '3' ? 'selected' : ''}}>Amarela</option>
                                    <option value="4" {{old('racacor') == '4' ? 'selected' : ''}}>Parda</option>
                                    <option value="5" {{old('racacor') == '5' ? 'selected' : ''}}>Indígena</option>
                                    <option value="6" {{old('racacor') == '6' ? 'selected' : ''}}>Não se aplica</option>
                                    <option value="20" {{old('racacor') == '20' ? 'selected' : ''}}>Outra</option>
                                </select>
                                @error('racacor')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>


                        {{-- identidadegenero --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <label class="form-control-label" for="identidadegenero">Identidade de Gênero<span class="small text-danger">*</span></label>
                                <select name="identidadegenero" id="identidadegenero" class="form-control" >
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{old('identidadegenero') == '1' ? 'selected' : ''}}>Feminino</option>
                                    <option value="2" {{old('identidadegenero') == '2' ? 'selected' : ''}}>Transexual</option>
                                    <option value="3" {{old('identidadegenero') == '3' ? 'selected' : ''}}>Travesti</option>
                                    <option value="4" {{old('identidadegenero') == '4' ? 'selected' : ''}}>Transgenero</option>
                                    <option value="20" {{old('identidadegenero') == '20' ? 'selected' : ''}}>Outra</option>
                                </select>
                                @error('identidadegenero')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>


                        {{-- orientacaosexual --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <label class="form-control-label" for="orientacaosexual">Orientação Sexual<span class="small text-danger">*</span></label>
                                <select name="orientacaosexual" id="orientacaosexual" class="form-control" >
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{old('orientacaosexual') == '1' ? 'selected' : ''}}>Homossexual</option>
                                    <option value="2" {{old('orientacaosexual') == '2' ? 'selected' : ''}}>Heterossexual</option>
                                    <option value="3" {{old('orientacaosexual') == '3' ? 'selected' : ''}}>Bissexual</option>
                                    <option value="20" {{old('orientacaosexual') == '20' ? 'selected' : ''}}>Outra</option>
                                </select>
                                @error('orientacaosexual')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row mb-3">
                        {{-- outracomunidade --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <input type="text"  style="visibility:hidden" class="form-control" id="outracomunidade" name="outracomunidade" value="{{old('outracomunidade')}}" placeholder="especifique...">
                                @error('outracomunidade')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- outraracacor --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <input type="text" class="form-control" id="outraracacor" name="outraracacor" value="{{old('outraracacor')}}">
                                @error('outraracacor')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- outraidentidadegenero --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <input type="text" class="form-control" id="outraidentidadegenero" name="outraidentidadegenero" value="{{old('outraidentidadegenero')}}">
                                @error('outraidentidadegenero')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- outraorientacaosexual --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <input type="text" class="form-control" id="outraorientacaosexual" name="outraorientacaosexual" value="{{old('outraorientacaosexual')}}">
                                @error('outraorientacaosexual')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3" style="margin-top:30px">
                        {{-- deficiente --}}
                        <label for="deficientenao" class="col-3 col-form-label">Pessoa com deficiência ? <span class="small text-danger">*</span></label>
                        <div class="col-3">
                            <div style="margin-top:5px">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="deficiente" id="deficientesim" value="1" {{old('deficiente') == '1' ? 'checked' : ''}} >
                                    <label class="form-check-label" for="deficientesim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="deficiente" id="deficientenao" value="0" {{old('deficiente') == '0' ? 'checked' : ''}} >
                                    <label class="form-check-label" for="deficientenao">Não</label>
                                </div>
                                <br>
                                @error('deficiente')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group focused">
                                <input type="text" class="form-control" id="deficiencia" name="deficiencia" value="{{old('deficiencia')}}">
                                @error('deficiencia')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <hr>



                    <div class="mb-4 row">
                        {{-- endereco --}}
                        <label for="endereco" class="col-sm-2 col-form-label">Endereço <span class="small text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="endereco" value="{{ old('endereco') }}" class="form-control" id="endereco">
                            @error('endereco')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>

                        {{-- numero --}}
                        <label for="numero" class="col-sm-1 col-form-label">Número <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="numero" value="{{ old('numero') }}" class="form-control" id="numero">
                            @error('numero')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>



                    <div class="mb-4 row">
                         {{-- complemento --}}
                        <label for="complemento" class="col-sm-2 col-form-label">Complemento</label>
                        <div class="col-sm-6">
                            <input type="text" name="complemento" value="{{ old('complemento') }}" class="form-control" id="complemento">
                        </div>

                        {{-- bairro --}}
                        <label for="bairro" class="col-sm-1 col-form-label">Bairro <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="bairro" value="{{ old('bairro') }}" class="form-control" id="bairro" placeholder="Bairro" >
                            @error('bairro')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>


                    {{-- cep --}}
                    <div class="mb-4 row">
                         {{-- municipio_id --}}
                        <label for="municipio_id" class="col-sm-2 col-form-label">Município <span class="small text-danger">*</span></label>
                        <div class="col-sm-6">
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

                         {{-- cep --}}
                        <label for="cep" class="col-sm-1 col-form-label">CEP <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="cep" value="{{ old('cep') }}" class="form-control" id="cep" placeholder="cep" >
                            @error('cep')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-4 row">
                        {{-- foneresidencial --}}
                        <label for="foneresidencial" class="col-sm-2 col-form-label">Telefones <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="foneresidencial" value="{{ old('foneresidencial') }}" class="form-control mask-cell" id="foneresidencial" placeholder="residencial" >
                            @error('foneresidencial')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>

                        {{-- fonecelular --}}
                        <div class="col-sm-3">
                            <input type="text" name="fonecelular" value="{{ old('fonecelular') }}" class="form-control mask-cell" id="fonecelular" placeholder="celular" >
                            @error('fonecelular')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>

                        <label for="email" class="col-sm-1 col-form-label">E-mail <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email">
                            @error('email')
                              <small style="color: red">{{$message}}</small>
                            @enderror
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
        $("#comunidade").on("change", function() {
            var comunidade = $(this).find(":selected").val();

            if(comunidade == "20"){
                $("#outracomunidade").css("visibility","visible");
                $("#outracomunidade").focus();
            }else{
                $("#outracomunidade").css("visibility","hidden");
                $("#outracomunidade").val("");
            }
        });

        /* if($("#formcadastrorequerente").submit(function() {
            alert("Submitted");
            if(comunidade == "20"){
                $("#outracomunidade").css("visibility","visible");
            }
        })); */

        if($("#formcadastrorequerente").submited()){

        }else{
            alert("Não submetido");
        }

    </script>

@endsection
