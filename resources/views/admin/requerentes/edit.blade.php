@extends('layout.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">REQUERENTE -  edição</h2>
            {{-- <ol class="mt-3 mb-3 breadcrumb ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Requerentes</a></li>
                <li class="breadcrumb-item active">Requerente</li>
            </ol> --}}
        </div>

        <div class="mb-4 shadow card border-light">
            <div class="gap-2 card-header hstack">
                <span class="p-2 small text-danger"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                <x-alert />

                {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
                <x-errorexception />

                <form action="{{ route('requerente.update', ['requerente' => $requerente->id]) }}" method="POST" autocomplete="off" id="formcadastrorequerente" style ="background-image: url('{{ asset("images/background_06_opct5.png")}}'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-size: 100% 100%;">
                    @csrf
                    @method('PUT')

                    <div class="col-12" style="padding:10px; margin-bottom: 15px; text-align: center; background-color: #e9e9e9">
                        <label><strong>INFORMAÇÕES DA REQUERENTE</strong></label>
                    </div>

                    <div class="mb-3 row">

                        {{-- Nomecompleto --}}
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="nomecompleto">Nome <span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="nomecompleto" name="nomecompleto" value="{{ old('nomecompleto', $requerente->nomecompleto) }}" required>
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
                                        <input class="form-check-input" type="radio" name="sexobiologico" id="sexobiologicomas" value="masculino" {{ old('sexobiologico', $requerente->sexobiologico) == 'masculino' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="sexobiologicomas">Masculino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexobiologico" id="sexobiologicofem" value="feminino" {{ old('sexobiologico', $requerente->sexobiologico) == 'feminino' ? 'checked' : ''}} required>
                                        <label class="form-check-label" for="sexobiologicofem">Feminino</label>
                                    </div>
                                    <br>
                                    @error('sexobiologico')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        {{-- nascimento --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="nascimento">Data de Nascimento <span class="small text-danger">*</span></label>
                                <input type="date" class="form-control" id="nascimento" name="nascimento" value="{{old('nascimento', $requerente->nascimento)}}" required>
                                @error('nascimento')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- naturalidade --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="naturalidade">Naturalidade / UF<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="naturalidade" name="naturalidade" value="{{old('naturalidade', $requerente->naturalidade)}}" required>
                                @error('naturalidade')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- nacionalidade --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="nacionalidade">Nacionalidade <span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" value="{{old('nacionalidade', $requerente->nacionalidade)}}" required>
                                @error('nacionalidade')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-3 row">
                        {{-- rg --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="rg">RG<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="rg" name="rg" value="{{ old('rg', $requerente->rg) }}" required>
                                @error('rg')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- orgaoexpedidor --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="orgaoexpedidor">Órgão Expedidor<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="orgaoexpedidor" name="orgaoexpedidor" value="{{ old('orgaoexpedidor', $requerente->orgaoexpedidor) }}" required>
                                @error('orgaoexpedidor')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- cpf --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="cpf">CPF<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $requerente->cpf) }}" required>
                                @error('cpf')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- banco --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="banco">Banco <span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="banco" name="banco" value="{{ old('banco', $requerente->banco) }}" required>
                                @error('banco')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- agencia --}}
                        <div class="col-1">
                            <div class="form-group focused">
                                <label class="form-control-label" for="agencia">Agência<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="agencia" name="agencia" value="{{ old('agencia', $requerente->agencia) }}" required>
                                @error('agencia')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- conta --}}
                        <div class="col-1">
                            <div class="form-group focused">
                                <label class="form-control-label" for="conta">Conta Corrente<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="conta" name="conta" value="{{ old('conta', $requerente->conta) }}" required>
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
                                        <input class="form-check-input" type="radio" name="contaespecifica" id="contaespecificasim" value="1" {{ old('contaespecifica', $requerente->contaespecifica) == '1' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="contaespecificasim">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contaespecifica" id="contaespecificanao" value="0" {{ old('contaespecifica', $requerente->contaespecifica) == '0' ? 'checked' : '' }}>
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

                    <div class="mb-3 row">
                        {{-- comunidade --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <label class="form-control-label" for="comunidade">Comunidade especifica/tradicional<span class="small text-danger">*</span></label>
                                <select name="comunidade" id="comunidade" class="form-control" required>
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{ old('comunidade', $requerente->comunidade) == '1' ? 'selected' : '' }}>Cigano</option>
                                    <option value="2" {{ old('comunidade', $requerente->comunidade) == '2' ? 'selected' : '' }}>Quilombola</option>
                                    <option value="3" {{ old('comunidade', $requerente->comunidade) == '3' ? 'selected' : '' }}>Matriz Africana</option>
                                    <option value="4" {{ old('comunidade', $requerente->comunidade) == '4' ? 'selected' : '' }}>Indígena</option>
                                    <option value="5" {{ old('comunidade', $requerente->comunidade) == '5' ? 'selected' : '' }}>Assentado / acampado</option>
                                    <option value="6" {{ old('comunidade', $requerente->comunidade) == '6' ? 'selected' : '' }}>Pessoa do campo / floresta</option>
                                    <option value="7" {{ old('comunidade', $requerente->comunidade) == '7' ? 'selected' : '' }}>Pessoa em situação de rua</option>
                                    <option value="20" {{ old('comunidade', $requerente->comunidade) == '20' ? 'selected' : '' }}>Outra</option>
                                </select>
                                @error('comunidade')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>


                        {{-- racacor --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <label class="form-control-label" for="racacor">Cor / Raça / Etnia<span class="small text-danger">*</span></label>
                                <select name="racacor" id="racacor" class="form-control"  required>
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{ old('racacor', $requerente->racacor) == '1' ? 'selected' : '' }}>Branca</option>
                                    <option value="2" {{ old('racacor', $requerente->racacor) == '2' ? 'selected' : '' }}>Preta</option>
                                    <option value="3" {{ old('racacor', $requerente->racacor) == '3' ? 'selected' : '' }}>Amarela</option>
                                    <option value="4" {{ old('racacor', $requerente->racacor) == '4' ? 'selected' : '' }}>Parda</option>
                                    <option value="5" {{ old('racacor', $requerente->racacor) == '5' ? 'selected' : '' }}>Indígena</option>
                                    <option value="6" {{ old('racacor', $requerente->racacor) == '6' ? 'selected' : '' }}>Não se aplica</option>
                                    <option value="20" {{ old('racacor', $requerente->racacor) == '20' ? 'selected' : '' }}>Outra</option>
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
                                <select name="identidadegenero" id="identidadegenero" class="form-control"  required>
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{ old('identidadegenero', $requerente->identidadegenero) == '1' ? 'selected' : '' }}>Feminino</option>
                                    <option value="2" {{ old('identidadegenero', $requerente->identidadegenero) == '2' ? 'selected' : '' }}>Transexual</option>
                                    <option value="3" {{ old('identidadegenero', $requerente->identidadegenero) == '3' ? 'selected' : '' }}>Travesti</option>
                                    <option value="4" {{ old('identidadegenero', $requerente->identidadegenero) == '4' ? 'selected' : '' }}>Transgênero</option>
                                    <option value="20" {{ old('identidadegenero', $requerente->identidadegenero) == '20' ? 'selected' : '' }}>Outra</option>
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
                                <select name="orientacaosexual" id="orientacaosexual" class="form-control"  required>
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{ old('orientacaosexual', $requerente->orientacaosexual) == '1' ? 'selected' : '' }}>Homossexual</option>
                                    <option value="2" {{ old('orientacaosexual', $requerente->orientacaosexual) == '2' ? 'selected' : '' }}>Heterossexual</option>
                                    <option value="3" {{ old('orientacaosexual', $requerente->orientacaosexual) == '3' ? 'selected' : '' }}>Bissexual</option>
                                    <option value="20" {{ old('orientacaosexual', $requerente->orientacaosexual) == '20' ? 'selected' : '' }}>Outra</option>
                                </select>
                                @error('orientacaosexual')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="mb-3 row">
                        {{-- outracomunidade --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <input type="text"  style="visibility:hidden" class="form-control" id="outracomunidade" name="outracomunidade" value="{{ old('outracomunidade', $requerente->outracomunidade) }}" placeholder="especifique...">
                                @error('outracomunidade')
                                    <small style="color: red" id="msg_error_outracomunidade">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- outraracacor --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <input type="text"  style="visibility:hidden" class="form-control" id="outraracacor" name="outraracacor" value="{{ old('outraracacor', $requerente->outraracacor) }}" placeholder="especifique...">
                                @error('outraracacor')
                                    <small style="color: red" id="msg_error_outraracacor">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- outraidentidadegenero --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <input type="text" style="visibility:hidden" class="form-control" id="outraidentidadegenero" name="outraidentidadegenero" value="{{ old('outraidentidadegenero', $requerente->outraidentidadegenero) }}" placeholder="especifique...">
                                @error('outraidentidadegenero')
                                    <small style="color: red" id="msg_error_outraidentidadegenero">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- outraorientacaosexual --}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <input type="text" style="visibility:hidden" class="form-control" id="outraorientacaosexual" name="outraorientacaosexual" value="{{ old('outraorientacaosexual', $requerente->outraorientacaosexual) }}" placeholder="especifique...">
                                @error('outraorientacaosexual')
                                    <small style="color: red"  id="msg_error_outraorientacaosexual">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-4 row" style="margin-top:30px">
                        {{-- deficiente --}}
                        <div class="col-3">
                            <div style="margin-top:5px">
                                <label for="deficientenao" class="col-form-label">Pessoa com deficiência ? <span class="small text-danger" style="margin-right: 20px">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="deficiente" id="deficientesim" value="1" {{ old('deficiente', $requerente->deficiente) == '1' ? 'checked' : '' }}  required>
                                    <label class="form-check-label" for="deficientesim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="deficiente" id="deficientenao" value="0" {{ old('deficiente', $requerente->deficiente) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="deficientenao">Não</label>
                                </div>
                                <br>
                                @error('deficiente')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- deficiência ---}}
                        <div class="col-3">
                            <div class="form-group focused">
                                <br>
                                <input type="text" style="visibility:hidden" class="form-control" id="deficiencia" name="deficiencia" value="{{ old('deficiencia', $requerente->deficiencia) }}" placeholder="especifique...">
                                @error('deficiencia')
                                    <small style="color: red" id="msg_error_deficiencia">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- escolaridade --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="escolaridade">Escolaridade<span class="small text-danger">*</span></label>
                                <select name="escolaridade" id="escolaridade" class="form-control"  required>
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{old('escolaridade', $requerente->escolaridade) == '1' ? 'selected' : ''}}>Fundamental incompleto</option>
                                    <option value="2" {{old('escolaridade', $requerente->escolaridade) == '2' ? 'selected' : ''}}>Fundamental completo</option>
                                    <option value="3" {{old('escolaridade', $requerente->escolaridade) == '3' ? 'selected' : ''}}>Médio incompleto</option>
                                    <option value="4" {{old('escolaridade', $requerente->escolaridade) == '4' ? 'selected' : ''}}>Médio completo</option>
                                    <option value="5" {{old('escolaridade', $requerente->escolaridade) == '5' ? 'selected' : ''}}>Superior incompleto</option>
                                    <option value="6" {{old('escolaridade', $requerente->escolaridade) == '6' ? 'selected' : ''}}>Superior completo</option>
                                    <option value="7" {{old('escolaridade', $requerente->escolaridade) == '7' ? 'selected' : ''}}>Pós-graduação incompleto</option>
                                    <option value="8" {{old('escolaridade', $requerente->escolaridade) == '8' ? 'selected' : ''}}>Pós-graduação completo</option>
                                </select>
                                @error('escolaridade')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- profissao --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="profissao">Profissão <span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="profissao" name="profissao" value="{{ old('profissao', $requerente->profissao) }}" required>
                                @error('profissao')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- estadocivil --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <label class="form-control-label" for="estadocivil">Estado Civil<span class="small text-danger">*</span></label>
                                <select name="estadocivil" id="estadocivil" class="form-control"  required>
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="1" {{old('estadocivil', $requerente->estadocivil) == '1' ? 'selected' : ''}}>Solteira</option>
                                    <option value="2" {{old('estadocivil', $requerente->estadocivil) == '2' ? 'selected' : ''}}>Casada</option>
                                    <option value="3" {{old('estadocivil', $requerente->estadocivil) == '3' ? 'selected' : ''}}>Divorciada</option>
                                    <option value="4" {{old('estadocivil', $requerente->estadocivil) == '4' ? 'selected' : ''}}>Viúva</option>
                                    <option value="20" {{old('estadocivil', $requerente->estadocivil) == '20' ? 'selected' : ''}}>Outra</option>
                                </select>
                                @error('estadocivil')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <hr style="border: none; height: 3px; background-color: #545454;">



                    <div class="mb-4 row">
                        {{-- endereco --}}
                        <label for="endereco" class="col-sm-2 col-form-label">Endereço <span class="small text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="endereco" value="{{ old('endereco', $requerente->endereco) }}" class="form-control" id="endereco" required>
                            @error('endereco')
                              <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>

                        {{-- numero --}}
                        <label for="numero" class="col-sm-1 col-form-label">Número <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="numero" value="{{ old('numero', $requerente->numero) }}" class="form-control" id="numero" required>
                            @error('numero')
                              <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>



                    <div class="mb-4 row">
                         {{-- complemento --}}
                        <label for="complemento" class="col-sm-2 col-form-label">Complemento</label>
                        <div class="col-sm-6">
                            <input type="text" name="complemento" value="{{ old('complemento', $requerente->complemento) }}" class="form-control" id="complemento">
                        </div>

                        {{-- bairro --}}
                        <label for="bairro" class="col-sm-1 col-form-label">Bairro <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="bairro" value="{{ old('bairro', $requerente->bairro) }}" class="form-control" id="bairro" required>
                            @error('bairro')
                              <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    {{-- municipio_id --}}
                    <div class="mb-4 row">
                         {{-- municipio_id --}}
                        <label for="municipio_id" class="col-sm-2 col-form-label">Município <span class="small text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select name="municipio_id" id="municipio_id" class="form-control select2"  required>
                                <option value="" selected disabled>Escolha...</option>
                                @foreach($municipios as $municipio)
                                    <option value="{{ $municipio->id }}" {{ old('municipio_id', $requerente->municipio_id) == $municipio->id ? 'selected' : '' }}>{{ $municipio->nome }}</option>
                                @endforeach
                            </select>
                            @error('municpio_id')
                              <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                         {{-- cep --}}
                        <label for="cep" class="col-sm-1 col-form-label">CEP <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="cep" value="{{ old('cep', $requerente->cep) }}" class="form-control cep" id="cep" placeholder="cep" required>
                            @error('cep')
                              <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-4 row">
                        {{-- foneresidencial --}}
                        <label for="foneresidencial" class="col-sm-2 col-form-label">Telefones <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="foneresidencial" value="{{ old('foneresidencial', $requerente->foneresidencial) }}" class="form-control mask-cell" id="foneresidencial" placeholder="residencial" >
                            @error('foneresidencial')
                              <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- fonecelular --}}
                        <div class="col-sm-3">
                            <input type="text" name="fonecelular" value="{{ old('fonecelular', $requerente->fonecelular) }}" class="form-control mask-cell" id="fonecelular" placeholder="celular" >
                            @error('fonecelular')
                              <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <label for="email" class="col-sm-1 col-form-label">E-mail <span class="small text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="email" name="email" value="{{ old('email', $requerente->email) }}" class="form-control" id="email">
                            @error('email')
                              <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>



                    <div class="col-12" style="padding:10px; margin-top: 50px; margin-bottom: 15px; text-align: center; background-color: #e9e9e9">
                        <label><strong>DETALHAMENTO DO REQUERIMENTO</strong></label>
                    </div>

                    <div class="mb-4 row">
                        {{-- processojudicial --}}
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="processojudicial">Processo Judicial em que foi concedida a medida protetiva <span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="processojudicial" name="processojudicial" value="{{ old('processojudicial', $requerente->detalhe->processojudicial) }}" required>
                                @error('processojudicial')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        {{-- orgaojudiciario --}}
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="orgaojudicial">Órgao Judicial <span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="orgaojudicial" name="orgaojudicial" value="{{ old('orgaojudicial', $requerente->detalhe->orgaojudicial) }}" required>
                                @error('orgaojudicial')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- comarca --}}
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="comarca">Comarca<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="comarca" name="comarca" value="{{ old('comarca', $requerente->detalhe->comarca) }}" required>
                                @error('comarca')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-4 row">
                        {{-- prazomedidaprotetiva --}}
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="prazomedidaprotetiva">Prazo da medida protetiva (em dias) <span class="small text-danger">*</span></label>
                                <input type="number" min="1" class="form-control" id="prazomedidaprotetiva" name="prazomedidaprotetiva" value="{{ old('prazomedidaprotetiva', $requerente->detalhe->prazomedidaprotetiva) }}" required>
                                @error('prazomedidaprotetiva')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- dataconcessaomedidaprotetiva --}}
                        <div class="col-4 offset-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="dataconcessaomedidaprotetiva">Data em que foi concedida <span class="small text-danger">*</span></label>
                                <input type="date" class="form-control" id="dataconcessaomedidaprotetiva" name="dataconcessaomedidaprotetiva" value="{{ old('dataconcessaomedidaprotetiva', $requerente->detalhe->dataconcessaomedidaprotetiva) }}" required>
                                @error('dataconcessaomedidaprotetiva')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>


                    {{-- item 2.6.1 --}}
                    <div class="mb-2 row destaque">
                        <label for="medproturgcaminhaprogoficial" class="col-sm-8 col-form-label">
                            A requerente foi atendida com a medida protetiva de urgência de encaminhamento a programa oficial ou comunitário de proteção ou atendimento? (art. 23, I, Lei 11.340/2006) *
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="medproturgcaminhaprogoficial" id="medproturgcaminhaprogoficialsim" value="1" {{ old('medproturgcaminhaprogoficial', $requerente->detalhe->medproturgcaminhaprogoficial) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="medproturgcaminhaprogoficialsim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input desabilitaconcessaobeneficio" type="radio" name="medproturgcaminhaprogoficial" id="medproturgcaminhaprogoficialnao" value="0" {{ old('medproturgcaminhaprogoficial', $requerente->detalhe->medproturgcaminhaprogoficial) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="medproturgcaminhaprogoficialnao">Não</label>
                                </div>
                                <br>
                                @error('medproturgcaminhaprogoficial')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.2 --}}
                    <div class="mb-2 row destaque">
                        <label for="medproturgafastamentolar" class="col-sm-8 col-form-label">
                            A requerente foi atendida com a medida protetiva de urgência de afastamento do lar?  (art. 23, III, Lei 11.340/2006) *
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="medproturgafastamentolar" id="medproturgafastamentolarsim" value="1" {{ old('medproturgafastamentolar', $requerente->detalhe->medproturgafastamentolar) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="medproturgafastamentolarsim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input desabilitaconcessaobeneficio" type="radio" name="medproturgafastamentolar" id="medproturgafastamentolarnao" value="0" {{ old('medproturgafastamentolar', $requerente->detalhe->medproturgafastamentolar) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="medproturgafastamentolarnao">Não</label>
                                </div>
                                <br>
                                @error('medproturgafastamentolar')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.3 --}}
                    <div class="mb-2 row destaque">
                        <label for="riscmortvioldomesmoradprotegsigilosa" class="col-sm-8 col-form-label">
                            A requerente encontra-se em situação de risco de vida iminente em razão de violência doméstica, carecendo de moradia protegida em caráter sigiloso?
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="riscmortvioldomesmoradprotegsigilosa" id="riscmortvioldomesmoradprotegsigilosasim" value="1" {{ old('riscmortvioldomesmoradprotegsigilosa', $requerente->detalhe->riscmortvioldomesmoradprotegsigilosa) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="riscmortvioldomesmoradprotegsigilosasim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="riscmortvioldomesmoradprotegsigilosa" id="riscmortvioldomesmoradprotegsigilosanao" value="0" {{ old('riscmortvioldomesmoradprotegsigilosa', $requerente->detalhe->riscmortvioldomesmoradprotegsigilosa) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="riscmortvioldomesmoradprotegsigilosanao">Não</label>
                                </div>
                                <br>
                                @error('riscmortvioldomesmoradprotegsigilosa')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.4 --}}
                    <div class="mb-2 row destaque">
                        <label for="riscvidaaguardmedproturg" class="col-sm-8 col-form-label">
                            A requerente encontra-se em situação de risco de morte, aguardando medida protetiva de urgência?
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="riscvidaaguardmedproturg" id="riscvidaaguardmedproturgsim" value="1" {{ old('riscvidaaguardmedproturg', $requerente->detalhe->riscvidaaguardmedproturg) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="riscvidaaguardmedproturgsim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="riscvidaaguardmedproturg" id="riscvidaaguardmedproturgnao" value="0" {{ old('riscvidaaguardmedproturg', $requerente->detalhe->riscvidaaguardmedproturg) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="riscvidaaguardmedproturgnao">Não</label>
                                </div>
                                <br>
                                @error('riscvidaaguardmedproturg')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.5--}}
                    <div class="mb-2 row destaque">
                        <label for="relatodescomprmedproturgagressor" class="col-sm-8 col-form-label">
                            A requerente encontra-se em situação de risco de morte e relata descumprimento de medida protetiva de urgência pelo agressor, necessitando de proteção até que se efetive a prisão deste?
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="relatodescomprmedproturgagressor" id="relatodescomprmedproturgagressorsim" value="1" {{ old('relatodescomprmedproturgagressor', $requerente->detalhe->relatodescomprmedproturgagressor) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="relatodescomprmedproturgagressorsim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="relatodescomprmedproturgagressor" id="relatodescomprmedproturgagressornao" value="0" {{ old('relatodescomprmedproturgagressor', $requerente->detalhe->relatodescomprmedproturgagressor) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="relatodescomprmedproturgagressornao">Não</label>
                                </div>
                                <br>
                                @error('relatodescomprmedproturgagressor')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.6--}}
                    <div class="mb-2 row destaque">
                        <label for="sitvulnerabnaoconsegarcardespmoradia" class="col-sm-8 col-form-label">
                            A requerente está em situação de vulnerabilidade, de forma a não conseguir arcar com as despesas de moradia? *
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sitvulnerabnaoconsegarcardespmoradia" id="sitvulnerabnaoconsegarcardespmoradiasim" value="1" {{ old('sitvulnerabnaoconsegarcardespmoradia', $requerente->detalhe->sitvulnerabnaoconsegarcardespmoradia) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="sitvulnerabnaoconsegarcardespmoradiasim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input desabilitaconcessaobeneficio" type="radio" name="sitvulnerabnaoconsegarcardespmoradia" id="sitvulnerabnaoconsegarcardespmoradianao" value="0" {{ old('sitvulnerabnaoconsegarcardespmoradia', $requerente->detalhe->sitvulnerabnaoconsegarcardespmoradia) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="sitvulnerabnaoconsegarcardespmoradianao">Não</label>
                                </div>
                                <br>
                                @error('sitvulnerabnaoconsegarcardespmoradia')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.7--}}
                    <div class="mb-2 row destaque">
                        <label for="temrendfamiliardoissalconvivagressor" class="col-sm-8 col-form-label">
                            requerente tem renda familiar de no máximo 02 salários, mesmo durante o convívio com o agressor? *
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temrendfamiliardoissalconvivagressor" id="temrendfamiliardoissalconvivagressorsim" value="1" {{ old('temrendfamiliardoissalconvivagressor', $requerente->detalhe->temrendfamiliardoissalconvivagressor) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="temrendfamiliardoissalconvivagressorsim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input desabilitaconcessaobeneficio" type="radio" name="temrendfamiliardoissalconvivagressor" id="temrendfamiliardoissalconvivagressornao" value="0" {{ old('temrendfamiliardoissalconvivagressor', $requerente->detalhe->temrendfamiliardoissalconvivagressor) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="temrendfamiliardoissalconvivagressornao">Não</label>
                                </div>
                                <br>
                                @error('temrendfamiliardoissalconvivagressor')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.8--}}
                    <div class="mb-2 row destaque">
                        <label for="possuiparenteporeminviavelcompartilhardomicilio" class="col-sm-8 col-form-label">
                            {{-- A requerente não possui pais, avós, filhos ou netos maiores de idade, no mesmo município de sua residência? * --}}
                            A requerente possui parentes em linha reta no município, porém não é viável o compartilhamento de domicílio nos termos do art 1º, VI, do Decreto 37.341, de 23 de dezembro de 2021 ? *
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="possuiparenteporeminviavelcompartilhardomicilio" id="possuiparenteporeminviavelcompartilhardomiciliosim" value="1" {{old('possuiparenteporeminviavelcompartilhardomicilio', $requerente->detalhe->possuiparenteporeminviavelcompartilhardomicilio) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="possuiparenteporeminviavelcompartilhardomiciliosim">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input desabilitaconcessaobeneficio" type="radio" name="possuiparenteporeminviavelcompartilhardomicilio" id="possuiparenteporeminviavelcompartilhardomicilionao" value="0" {{old('possuiparenteporeminviavelcompartilhardomicilio', $requerente->detalhe->possuiparenteporeminviavelcompartilhardomicilio) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="possuiparenteporeminviavelcompartilhardomicilionao">Não</label>
                                </div>
                                <br>
                                @error('possuiparenteporeminviavelcompartilhardomicilio')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- parentesinviavelcompartilhardomicilio --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <input type="text" class="form-control" style="visibility:hidden" id="parentesinviavelcompartilhardomicilio" name="parentesinviavelcompartilhardomicilio" value="{{ old('parentesinviavelcompartilhardomicilio', $requerente->detalhe->parentesinviavelcompartilhardomicilio) }}" placeholder="Quais">
                                @error('parentesinviavelcompartilhardomicilio')
                                    <small style="color: red"  id="msg_error_parentesinviavelcompartilhardomicilio">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.9--}}
                    <div class="mb-2 row destaque">
                        <label for="filhosmenoresidade" class="col-sm-8 col-form-label">
                            A requerente possui filhos menores de idade?
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="filhosmenoresidade" id="filhosmenoresidadesim" value="1" {{ old('filhosmenoresidade', $requerente->detalhe->filhosmenoresidade) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="filhosmenoresidadesim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="filhosmenoresidade" id="filhosmenoresidadenao" value="0" {{ old('filhosmenoresidade', $requerente->detalhe->filhosmenoresidade) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="filhosmenoresidadenao">Não</label>
                                </div>
                                <br>
                                @error('filhosmenoresidade')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- quantidadefilhosmenores --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <input type="number" min="1" class="form-control"  style="visibility:hidden" id="quantidadefilhosmenores" name="quantidadefilhosmenores"  value="{{ old('quantidadefilhosmenores', $requerente->detalhe->quantidadefilhosmenores) }}" placeholder="Quantidade">
                                @error('quantidadefilhosmenores')
                                    <small style="color: red" id="msg_error_quantidadefilhosmenores">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>




                    {{-- item 2.6.10--}}
                    <div class="mb-2 row destaque">
                        <label for="trabalhaougerarenda" class="col-sm-8 col-form-label">
                            A requerente está trabalhando ou possui alguma forma de gerar renda no momento?
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="trabalhaougerarenda" id="trabalhaougerarendasim" value="1" {{ old('trabalhaougerarenda', $requerente->detalhe->trabalhaougerarenda) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="trabalhaougerarendasim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="trabalhaougerarenda" id="trabalhaougerarendanao" value="0" {{ old('trabalhaougerarenda', $requerente->detalhe->trabalhaougerarenda) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="trabalhaougerarendanao">Não</label>
                                </div>
                                <br>
                                @error('trabalhaougerarenda')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- valortrabalhorenda --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <input type="text" class="form-control"  style="visibility:hidden" id="valortrabalhorenda" name="valortrabalhorenda" value="{{ old('valortrabalhorenda', isset($requerente->detalhe->valortrabalhorenda) ? number_format($requerente->detalhe->valortrabalhorenda, '2',',','.') : '') }}" placeholder="Valor">
                                @error('valortrabalhorenda')
                                    <small style="color: red" id="msg_error_valortrabalhorenda">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    {{-- item 2.6.11--}}
                    <div class="mb-2 row destaque">
                        <label for="temcadunico" class="col-sm-8 col-form-label">
                            A requerente está cadastrada no Cadastro Único (CADÚNICO)? *
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temcadunico" id="temcadunicosim" value="1" {{ old('temcadunico', $requerente->detalhe->temcadunico) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="temcadunicosim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input desabilitaconcessaobeneficio" type="radio" name="temcadunico" id="temcaduniconao" value="0" {{ old('temcadunico', $requerente->detalhe->temcadunico) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="temcaduniconao">Não</label>
                                </div>
                                <br>
                                @error('temcadunico')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- valortemcadunico --}}
                        <div class="col-2">
                            <div class="form-group focused">
                                <input type="text" class="form-control"  style="visibility:hidden" id="valortemcadunico" name="valortemcadunico" value="{{ old('valortemcadunico', isset($requerente->detalhe->valortemcadunico) ? number_format($requerente->detalhe->valortemcadunico, '2',',','.') : '') }}" placeholder="Valor">
                                @error('valortemcadunico')
                                    <small style="color: red" id="msg_error_valortemcadunico">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    {{-- item 2.6.12--}}
                    <div class="mb-2 row destaque">
                        <label for="teminteresformprofisdesenvolvhabilid" class="col-sm-8 col-form-label">
                            A requerente tem interesse de participar de formações para qualificação profissional e de desenvolvimento de habilidades (cursos, oficinas, entre outros)?
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="teminteresformprofisdesenvolvhabilid" id="teminteresformprofisdesenvolvhabilidsim" value="1" {{ old('teminteresformprofisdesenvolvhabilid', $requerente->detalhe->teminteresformprofisdesenvolvhabilid) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="teminteresformprofisdesenvolvhabilidsim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="teminteresformprofisdesenvolvhabilid" id="teminteresformprofisdesenvolvhabilidnao" value="0" {{ old('teminteresformprofisdesenvolvhabilid', $requerente->detalhe->teminteresformprofisdesenvolvhabilid) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="teminteresformprofisdesenvolvhabilidnao">Não</label>
                                </div>
                                <br>
                                @error('teminteresformprofisdesenvolvhabilid')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>



                    {{-- item 2.6.13--}}
                    <div class="mb-2 row destaque">
                        <label for="apresentoudocumentoidentificacao" class="col-sm-8 col-form-label">
                            A requerente apresentou documento de identificação?
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="apresentoudocumentoidentificacao" id="apresentoudocumentoidentificacaosim" value="1" {{ old('apresentoudocumentoidentificacao', $requerente->detalhe->apresentoudocumentoidentificacao) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="apresentoudocumentoidentificacaosim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="apresentoudocumentoidentificacao" id="apresentoudocumentoidentificacaonao" value="0" {{ old('apresentoudocumentoidentificacao', $requerente->detalhe->apresentoudocumentoidentificacao) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="apresentoudocumentoidentificacaonao">Não</label>
                                </div>
                                <br>
                                @error('apresentoudocumentoidentificacao')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    {{-- item 2.6.14--}}
                    <div class="mb-2 row destaque">
                        <label for="cumprerequisitositensnecessarios" class="col-sm-8 col-form-label">
                            <strong>A requerente cumpre os requisitos previstos nos itens marcados com (*), necessários para concessão do benefício?</strong>
                        </label>
                        <div class="col-sm-2">
                            <div style="margin-top: 10px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cumprerequisitositensnecessarios" id="cumprerequisitositensnecessariossim" value="1" {{ old('cumprerequisitositensnecessarios', $requerente->detalhe->cumprerequisitositensnecessarios) == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="cumprerequisitositensnecessariossim">Sim</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input desabilitaconcessaobeneficio" type="radio" name="cumprerequisitositensnecessarios" id="cumprerequisitositensnecessariosnao" value="0" {{ old('cumprerequisitositensnecessarios', $requerente->detalhe->cumprerequisitositensnecessarios) == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="cumprerequisitositensnecessariosnao">Não</label>
                                </div>
                                <br>
                                @error('cumprerequisitositensnecessarios')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <div class="col-sm-10"></div>
                        <div class="col-sm-2">
                            <div style="margin-top: 15px">
                                <a class="btn btn-outline-secondary" href="{{ route('requerente.index')}}" role="button">Cancelar</a>
                                <button type="submit" id="btnsalvar" class="btn btn-primary" style="width: 95px;"> Salvar </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- inicio modal --}}
    <div class="modal fade avisoperdabeneficio" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><img src="{{ asset('images/alerta.png')}}" width="50" style="margin-right: 20px;">Aviso</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ESTA OPÇÃO DESABILITA A CONCESSÃO DO BENEFÍCIO
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fim modal --}}

@endsection

@section('scripts')
    <script>

        // Torna visível o campo "outracomunidade", caso o valor escolhido do select(comunidade) seja 20.
        if($("#comunidade").find(":selected").val() == 20){
            $("#outracomunidade").css("visibility","visible");
        }

        $("#comunidade").on("change", function() {
            var comunidade = $(this).find(":selected").val();
            if(comunidade == "20"){
                $("#outracomunidade").css("visibility","visible");
                $("#outracomunidade").focus();
                $("#outracomunidade").attr("required");
            }else{
                $("#outracomunidade").css("visibility","hidden");
                $("#outracomunidade").val("");
                $("#outracomunidade").removeAttr("required");
                $("#msg_error_outracomunidade").css("visibility","hidden");
            }
        });


        // Torna visível o campo "outraracacor", caso o valor escolhido do select(racacor) seja 20.
        if($("#racacor").find(":selected").val() == 20){
            $("#outraracacor").css("visibility","visible");
        }

        $("#racacor").on("change", function() {
            var racacor = $(this).find(":selected").val();
            if(racacor == "20"){
                $("#outraracacor").css("visibility","visible");
                $("#outraracacor").focus();
                $("#outraracacor").attr("required");
            }else{
                $("#outraracacor").css("visibility","hidden");
                $("#outraracacor").val("");
                $("#outraracacor").removeAttr("required");
                $("#msg_error_outraracacor").css("visibility","hidden");
            }
        });


        // Torna visível o campo "outraidentidadegenero", caso o valor escolhido do select(racacor) seja 20.
        if($("#identidadegenero").find(":selected").val() == 20){
            $("#outraidentidadegenero").css("visibility","visible");
        }

        $("#identidadegenero").on("change", function() {
            var identidadegenero = $(this).find(":selected").val();
            if(identidadegenero == "20"){
                $("#outraidentidadegenero").css("visibility","visible");
                $("#outraidentidadegenero").focus();
                $("#outraidentidadegenero").attr("required");
            }else{
                $("#outraidentidadegenero").css("visibility","hidden");
                $("#outraidentidadegenero").val("");
                $("#outraidentidadegenero").removeAttr("required");
                $("#msg_error_outraidentidadegenero").css("visibility","hidden");
            }
        });


        // Torna visível o campo "outraidentidadegenero", caso o valor escolhido do select(racacor) seja 20.
        if($("#orientacaosexual").find(":selected").val() == 20){
            $("#outraorientacaosexual").css("visibility","visible");
        }

        $("#orientacaosexual").on("change", function() {
            var orientacaosexual = $(this).find(":selected").val();
            if(orientacaosexual == "20"){
                $("#outraorientacaosexual").css("visibility","visible");
                $("#outraorientacaosexual").focus();
                $("#outraorientacaosexual").attr("required");
            }else{
                $("#outraorientacaosexual").css("visibility","hidden");
                $("#outraorientacaosexual").val("");
                $("#outraorientacaosexual").removeAttr("required");
                $("#msg_error_outraorientacaosexual").css("visibility","hidden");
            }
        });



        // Torna visível o campo "deficiência", caso o valor escolhido do radio(deficiente) seja 1.
        // var selectedValue = $('input[name="survey"]:checked').val();

        if($("input[name='deficiente']:checked").val() == "1"){
            $("#deficiencia").css("visibility","visible");
        }


        $("input[name='deficiente']").on("click", function() {
            var deficiente = $("input[name='deficiente']:checked").val();
            if(deficiente == "1"){
                $("#deficiencia").css("visibility","visible");
                $("#deficiencia").focus();
                $("#deficiencia").attr("required");
            }else{
                $("#deficiencia").css("visibility","hidden");
                $("#deficiencia").val("");
                $("#deficiencia").removeAttr("required");
                $("#msg_error_deficiencia").css("visibility","hidden");
            }
        });


        // Torna visível o campo "parentesinviavelcompartilhardomicilio", caso o valor escolhido do radio(possuiparenteporeminviavelcompartilhardomicilio) seja 1.
        if($("input[name='possuiparenteporeminviavelcompartilhardomicilio']:checked").val() == "1"){
            $("#parentesinviavelcompartilhardomicilio").css("visibility","visible");
        }


        $("input[name='possuiparenteporeminviavelcompartilhardomicilio']").on("click", function() {
            var possuiparenteporeminviavelcompartilhardomicilio = $("input[name='possuiparenteporeminviavelcompartilhardomicilio']:checked").val();
            if(possuiparenteporeminviavelcompartilhardomicilio == "1"){
                $("#parentesinviavelcompartilhardomicilio").css("visibility","visible");
                $("#parentesinviavelcompartilhardomicilio").focus();
                $("#parentesinviavelcompartilhardomicilio").attr("required");
            }else{
                $("#parentesinviavelcompartilhardomicilio").css("visibility","hidden");
                $("#parentesinviavelcompartilhardomicilio").val("");
                $("#parentesinviavelcompartilhardomicilio").removeAttr("required");
                $("#msg_error_parentesinviavelcompartilhardomicilio").css("visibility","hidden");
            }
        });



        // Iníco valor QUANTIDADE DE FILHOS MENORES
        // Torna visível o campo "quantidadefilhosmenores", caso o valor escolhido do radio(filhosmenoresidade) seja 1.
        if($("input[name='filhosmenoresidade']:checked").val() == "1"){
            $("#quantidadefilhosmenores").css("visibility","visible");
        }


        $("input[name='filhosmenoresidade']").on("click", function() {
            var filhosmenoresidade = $("input[name='filhosmenoresidade']:checked").val();
            if(filhosmenoresidade == "1"){
                $("#quantidadefilhosmenores").css("visibility","visible");
                $("#quantidadefilhosmenores").focus();
                $("#quantidadefilhosmenores").attr("required");
            }else{
                $("#quantidadefilhosmenores").css("visibility","hidden");
                $("#quantidadefilhosmenores").val("");
                $("#quantidadefilhosmenores").removeAttr("required");
                $("#msg_error_quantidadefilhosmenores").css("visibility","hidden");
            }
        });



        // Torna visível o campo "valortrabalhorenda", caso o valor escolhido do radio(trabalhaougerarenda) seja 1.
        if($("input[name='trabalhaougerarenda']:checked").val() == "1"){
            $("#valortrabalhorenda").css("visibility","visible");
        }


        $("input[name='trabalhaougerarenda']").on("click", function() {
            var trabalhaougerarenda = $("input[name='trabalhaougerarenda']:checked").val();
            if(trabalhaougerarenda == "1"){
                $("#valortrabalhorenda").css("visibility","visible");
                $("#valortrabalhorenda").focus();
                $("#valortrabalhorenda").attr("required");
            }else{
                $("#valortrabalhorenda").css("visibility","hidden");
                $("#valortrabalhorenda").val("");
                $("#valortrabalhorenda").removeAttr("required");
                $("#msg_error_valortrabalhorenda").css("visibility","hidden");
            }
        });


        // Recebe o seletor do campo valortrabalhorenda
        let inputValorTrabalhoRenda = document.getElementById('valortrabalhorenda');

        // Verifique se existe o seletor no HTML. Obs: Dependendo da página que você esteja, é possível que este seletor não exista, por isso a necessidade de testar sua existência
        if(inputValorTrabalhoRenda){

            // Aguardar o usuário digitar o valo no campo
            inputValorTrabalhoRenda.addEventListener('input', function(){

                // Obter o valor atual removendo qualquer caracter que não seja número
                let valueTrabalhoRenda = this.value.replace(/[^\d]/g, '');

                // Adicionar os separadores de milhares
                var formattedTrabalhoRenda = (valueTrabalhoRenda.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valueTrabalhoRenda.slice(-2);

                // Adicionar a vírgula e até dois dígitos se houver centavos
                if(formattedTrabalhoRenda.length > 2){
                    formattedTrabalhoRenda = formattedTrabalhoRenda.slice(0, -2) + "," + formattedTrabalhoRenda.slice(-2);
                }


                // Atualizar o valor do campo
                this.value = formattedTrabalhoRenda;

            });
        }


        /// Iníco valor CADUNICO
        // Torna visível o campo "valortemcadunico", caso o valor escolhido do radio(temcadunico) seja 1.
        if($("input[name='temcadunico']:checked").val() == "1"){
            $("#valortemcadunico").css("visibility","visible");
        }


        $("input[name='temcadunico']").on("click", function() {
            var temcadunico = $("input[name='temcadunico']:checked").val();
            if(temcadunico == "1"){
                $("#valortemcadunico").css("visibility","visible");
                $("#valortemcadunico").focus();
                $("#valortemcadunico").attr("required");
            }else{
                $("#valortemcadunico").css("visibility","hidden");
                $("#valortemcadunico").val("");
                $("#valortemcadunico").removeAttr("required");
                $("#msg_error_valortemcadunico").css("visibility","hidden");
            }
        });


        // Recebe o seletor do campo valortemcadunico
        let inputValorTemCadunico = document.getElementById('valortemcadunico');

        // Verifique se existe o seletor no HTML. Obs: Dependendo da página que você esteja, é possível que este seletor não exista, por isso a necessidade de testar sua existência
        if(inputValorTemCadunico){

            // Aguardar o usuário digitar o valo no campo
            inputValorTemCadunico.addEventListener('input', function(){

                // Obter o valor atual removendo qualquer caracter que não seja número
                let valueTemCadunico = this.value.replace(/[^\d]/g, '');

                // Adicionar os separadores de milhares
                var formattedValorTemCadunico = (valueTemCadunico.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valueTemCadunico.slice(-2);

                // Adicionar a vírgula e até dois dígitos se houver centavos
                if(formattedValorTemCadunico.length > 2){
                    formattedValorTemCadunico = formattedValorTemCadunico.slice(0, -2) + "," + formattedValorTemCadunico.slice(-2);
                }


                // Atualizar o valor do campo
                this.value = formattedValorTemCadunico;

            });
        }
        /// Fim valor CADUNICO



        // Disparando MODAL de aviso de PERCA DE CONCESSÃO DE BENEFÍCO
        $("input[name='medproturgcaminhaprogoficial']").on("click", function() {
            if($(this).val() == "0"){
                $("#btnsalvar").removeClass("btn-primary");
                $("#btnsalvar").addClass("btn-secondary");
                $("#btnsalvar").html("<i class='fa-solid fa-ban'></i> Salvar");

                $(".avisoperdabeneficio").modal("show");
                $("#btnsalvar").prop("disabled", true);
            }else{
                $("#btnsalvar").removeClass("btn-secondary");
                $("#btnsalvar").addClass("btn-primary");
                $("#btnsalvar").html("Salvar");
                $("#btnsalvar").prop("disabled", false);
                habilitabotaosalvar();
            }
        });

        $("input[name='medproturgafastamentolar']").on("click", function() {
            if($(this).val() == "0"){
                $("#btnsalvar").removeClass("btn-primary");
                $("#btnsalvar").addClass("btn-secondary");
                $("#btnsalvar").html("<i class='fa-solid fa-ban'></i> Salvar");

                $(".avisoperdabeneficio").modal("show");
                $("#btnsalvar").prop("disabled", true);
            }else{
                $("#btnsalvar").removeClass("btn-secondary");
                $("#btnsalvar").addClass("btn-primary");
                $("#btnsalvar").html("Salvar");
                $("#btnsalvar").prop("disabled", false);
                habilitabotaosalvar();
            }
        });

        $("input[name='sitvulnerabnaoconsegarcardespmoradia']").on("click", function() {
            if($(this).val() == "0"){
                $("#btnsalvar").removeClass("btn-primary");
                $("#btnsalvar").addClass("btn-secondary");
                $("#btnsalvar").html("<i class='fa-solid fa-ban'></i> Salvar");

                $(".avisoperdabeneficio").modal("show");
                $("#btnsalvar").prop("disabled", true);
            }else{
                $("#btnsalvar").removeClass("btn-secondary");
                $("#btnsalvar").addClass("btn-primary");
                $("#btnsalvar").html("Salvar");
                $("#btnsalvar").prop("disabled", false);
                habilitabotaosalvar();
            }
        });

        $("input[name='temrendfamiliardoissalconvivagressor']").on("click", function() {
            if($(this).val() == "0"){
                $("#btnsalvar").removeClass("btn-primary");
                $("#btnsalvar").addClass("btn-secondary");
                $("#btnsalvar").html("<i class='fa-solid fa-ban'></i> Salvar");

                $(".avisoperdabeneficio").modal("show");
                $("#btnsalvar").prop("disabled", true);
            }else{
                $("#btnsalvar").removeClass("btn-secondary");
                $("#btnsalvar").addClass("btn-primary");
                $("#btnsalvar").html("Salvar");
                $("#btnsalvar").prop("disabled", false);
                habilitabotaosalvar();
            }
        });

        $("input[name='possuiparenteporeminviavelcompartilhardomicilio']").on("click", function() {
            if($(this).val() == "0"){
                $("#btnsalvar").removeClass("btn-primary");
                $("#btnsalvar").addClass("btn-secondary");
                $("#btnsalvar").html("<i class='fa-solid fa-ban'></i> Salvar");

                $(".avisoperdabeneficio").modal("show");
                $("#btnsalvar").prop("disabled", true);
            }else{
                $("#btnsalvar").removeClass("btn-secondary");
                $("#btnsalvar").addClass("btn-primary");
                $("#btnsalvar").html("Salvar");
                $("#btnsalvar").prop("disabled", false);
                habilitabotaosalvar();
            }
        });

        $("input[name='temcadunico']").on("click", function() {
            if($(this).val() == "0"){
                $("#btnsalvar").removeClass("btn-primary");
                $("#btnsalvar").addClass("btn-secondary");
                $("#btnsalvar").html("<i class='fa-solid fa-ban'></i> Salvar");

                $(".avisoperdabeneficio").modal("show");
                $("#btnsalvar").prop("disabled", true);
            }else{
                $("#btnsalvar").removeClass("btn-secondary");
                $("#btnsalvar").addClass("btn-primary");
                $("#btnsalvar").html("Salvar");
                $("#btnsalvar").prop("disabled", false);
                habilitabotaosalvar();
            }
        });

        $("input[name='cumprerequisitositensnecessarios']").on("click", function() {
            if($(this).val() == "0"){
                $("#btnsalvar").removeClass("btn-primary");
                $("#btnsalvar").addClass("btn-secondary");
                $("#btnsalvar").html("<i class='fa-solid fa-ban'></i> Salvar");

                $(".avisoperdabeneficio").modal("show");
                $("#btnsalvar").prop("disabled", true);
            }else{
                $("#btnsalvar").removeClass("btn-secondary");
                $("#btnsalvar").addClass("btn-primary");
                $("#btnsalvar").html("Salvar");
                $("#btnsalvar").prop("disabled", false);
                habilitabotaosalvar();
            }
        });

        function habilitabotaosalvar(){
            $(".desabilitaconcessaobeneficio").each(function(){
                if($(this).is(':checked')) {
                    $("#btnsalvar").removeClass("btn-primary");
                    $("#btnsalvar").addClass("btn-secondary");
                    $("#btnsalvar").html("<i class='fa-solid fa-ban'></i> Salvar");

                    $("#btnsalvar").prop("disabled", true);
                }
            });
        }


    </script>

@endsection
