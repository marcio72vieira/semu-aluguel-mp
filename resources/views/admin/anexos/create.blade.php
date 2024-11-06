@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Documentos - {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} </h2>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small text-danger p-3"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                <form action="{{ route('anexo.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('POST')

                    <div class="row">
                        {{-- identificacao do requerente --}}
                        <input type="hidden" name="requerente_id_hidden" id="requerente_id_hidden" value="{{ $requerente->id }}">


                        {{-- url--}}
                        <div class="col-5">
                            <div class="form-group focused">
                                <label class="form-control-label" for="url">Documento (o arquivo deve ser do tipo .pdf)<span class="small text-danger">*</span></label>
                                <input type="file" id="url" style="display:block" name="url" value="{{ old('url') }}">
                                @error('url')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Nome --}}
                        {{-- <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="nome">Nome<span class="small text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" >
                                @error('nome')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- nome --}}
                        <div class="col-5">
                            <div class="form-group focused">
                                <label class="form-control-label" for="nome">Nome do Documento<span class="small text-danger">*</span></label>
                                <select name="nome" id="nome" class="form-control"  required>
                                    <option value="" selected disabled>Escolha ...</option>
                                    <option value="SOLICITAÇÃO DO BENEFÍCIO (OFÍCIO OU OUTROS)" {{old('nome') == 'SOLICITAÇÃO DO BENEFÍCIO (OFÍCIO OU OUTROS)' ? 'selected' : ''}}>SOLICITAÇÃO DO BENEFÍCIO (OFÍCIO OU OUTROS)</option>
                                    <option value="DOCUMENTO DE IDENTIDADE (RG) E CPF" {{old('nome') == 'DOCUMENTO DE IDENTIDADE (RG) E CPF' ? 'selected' : ''}}>DOCUMENTO DE IDENTIDADE (RG) E CPF</option>
                                    <option value="COMPROVANTE DE RESIDÊNCIA" {{old('nome') == 'COMPROVANTE DE RESIDÊNCIA' ? 'selected' : ''}}>COMPROVANTE DE RESIDÊNCIA</option>
                                    <option value="FORMULÁRIO PARA REQUERIMENTO DO BENEFÍCIO (DEVIDAMENTE PREENCHIDO)" {{old('nome') == 'FORMULÁRIO PARA REQUERIMENTO DO BENEFÍCIO (DEVIDAMENTE PREENCHIDO)' ? 'selected' : ''}}>FORMULÁRIO PARA REQUERIMENTO DO BENEFÍCIO (DEVIDAMENTE PREENCHIDO)</option>
                                    <option value="MEDIDA PROTETIVA - FUNDAMENTA DA NO ART 23 DA LEI 11.340/2006" {{old('nome') == 'MEDIDA PROTETIVA - FUNDAMENTA DA NO ART 23 DA LEI 11.340/2006' ? 'selected' : ''}}>MEDIDA PROTETIVA - FUNDAMENTA DA NO ART 23 DA LEI 11.340/2006</option>
                                    <option value="DECLARAÇÃO DE AUSÊNCIA DE PARENTES NO MUNICÍPIO PARA COMPARTILHAMENTO DO DOMICÍLIO" {{old('nome') == 'DECLARAÇÃO DE AUSÊNCIA DE PARENTES NO MUNICÍPIO PARA COMPARTILHAMENTO DO DOMICÍLIO' ? 'selected' : ''}}>DECLARAÇÃO DE AUSÊNCIA DE PARENTES NO MUNICÍPIO PARA COMPARTILHAMENTO DO DOMICÍLIO</option>
                                    <option value="DECLARAÇÃO DE VULNERABILIDADE SOCIOECONÔMICA" {{old('nome') == 'DECLARAÇÃO DE VULNERABILIDADE SOCIOECONÔMICA' ? 'selected' : ''}}>DECLARAÇÃO DE VULNERABILIDADE SOCIOECONÔMICA</option>
                                    <option value="CADÚNICO (PROGRAMA BOLSA FAMÍLIA)" {{old('nome') == 'CADÚNICO (PROGRAMA BOLSA FAMÍLIA)' ? 'selected' : ''}}>CADÚNICO (PROGRAMA BOLSA FAMÍLIA)</option>
                                    <option value="CERTIDÃO DE NASCIMENTO DO(S) FILHO(S) CASO POSSUIR" {{old('nome') == 'CERTIDÃO DE NASCIMENTO DO(S) FILHO(S) CASO POSSUIR' ? 'selected' : ''}}>CERTIDÃO DE NASCIMENTO DO(S) FILHO(S) CASO POSSUIR</option>
                                    <option value="RELATÓRIO SOCIAL (PREENCHIDO COM DATA E ASSINADO PELA ASSISTENTE SOCIAL)" {{old('nome') == 'RELATÓRIO SOCIAL (PREENCHIDO COM DATA E ASSINADO PELA ASSISTENTE SOCIAL)' ? 'selected' : ''}}>RELATÓRIO SOCIAL (PREENCHIDO COM DATA E ASSINADO PELA ASSISTENTE SOCIAL)</option>
                                    <option value="CONTA CORRENTE BANCÁRIA: FOTO DO CARTÃO OU PERFIL DA CONTA(APENAS C/C)" {{old('nome') == 'CONTA CORRENTE BANCÁRIA: FOTO DO CARTÃO OU PERFIL DA CONTA(APENAS C/C)' ? 'selected' : ''}}>CONTA CORRENTE BANCÁRIA: FOTO DO CARTÃO OU PERFIL DA CONTA(APENAS C/C)</option>
                                    <option value="CONTRATO DE LOCAÇÃO DE ALUGUEL (SOLICITAR APÓS 1º MÊS DE LOCAÇÃO DO IMOVÉL)" {{old('nome') == 'CONTRATO DE LOCAÇÃO DE ALUGUEL (SOLICITAR APÓS 1º MÊS DE LOCAÇÃO DO IMOVÉL)' ? 'selected' : ''}}>CONTRATO DE LOCAÇÃO DE ALUGUEL (SOLICITAR APÓS 1º MÊS DE LOCAÇÃO DO IMOVÉL)</option>
                                </select>
                                @error('nome')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-2 flex-row d-md-flex justify-content-end">
                            <div style="margin-top: 15px">
                                {{-- <a class="btn btn-outline-secondary me-2" href="{{ url()->previous() }}" role="button">Cancelar</a> --}}
                                <a class="btn btn-outline-secondary me-2" href="{{ route('anexo.index', ['requerente' => $requerente->id]) }}" role="button">Cancelar</a>
                                <button type="submit" class="btn btn-primary" style="width: 95px;"> Enviar </button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
