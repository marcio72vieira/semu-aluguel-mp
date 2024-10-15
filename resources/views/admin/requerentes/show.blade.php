@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">INFORMAÇÕES DA REQUERENTE - visualizar</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Requerentes</a></li>
                <li class="breadcrumb-item active">Requerente</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small p-2"><strong> Detalhes </strong></span>
            </div>

            <div class="card-body">

                <dl class="row">

                    <dt class="col-sm-2">Id</dt>
                    <dd class="col-sm-10">{{ $requerente->id }}</dd>

                    <dt class="col-sm-2">Nome Completo</dt>
                    <dd class="col-sm-10">{{ $requerente->nomecompleto }}</dd>

                    <dt class="col-sm-2">RG - Ógão Expedidor</dt>
                    <dd class="col-sm-10">{{ $requerente->rg }} {{ $requerente->orgaoexpedidor }}</dd>

                    <dt class="col-sm-2">CPF</dt>
                    <dd class="col-sm-10">{{ $requerente->cpf }}</dd>

                    <dt class="col-sm-2">Regional</dt>
                    <dd class="col-sm-10">{{ $requerente->municipio->regional->nome }}</dd>

                    <dt class="col-sm-2">Município</dt>
                    <dd class="col-sm-10">{{ $requerente->municipio->nome }}</dd>

                    <dt class="col-sm-2">Unidade de Atendimento</dt>
                    <dd class="col-sm-10">({{ $requerente->tipounidade->nome}}) {{ $requerente->unidadeatendimento->nome }}</dd>

                    <dt class="col-sm-2">Responsável</dt>
                    <dd class="col-sm-10">{{ $requerente->user->nomecompleto }}</dd>

                    <dt class="col-sm-2">Banco - Agência - Conta</dt>
                    <dd class="col-sm-10">{{ $requerente->banco }} - {{ $requerente->agencia }} - {{ $requerente->conta }}</dd>

                    <dt class="col-sm-2">Comunidade</dt>
                    {{--  <dd class="col-sm-10">{{ $comunidades[$requerente->comunidade] }} {{ $requerente->comunidade == '8' ? $requerente->outracomunidade : '' }}</dd> --}}
                    <dd class="col-sm-10">{{ $requerente->comunidade == '20' ? $requerente->outracomunidade : $arr_comunidade[$requerente->comunidade] }}</dd>

                    <dt class="col-sm-2">Cor/Raça</dt>
                    <dd class="col-sm-10">{{ $requerente->racacor == '20' ? $requerente->outraracacor : $arr_racacor[$requerente->racacor] }}</dd>

                    <dt class="col-sm-2">Identidade de Gênero</dt>
                    <dd class="col-sm-10">{{ $requerente->identidadegenero == '20' ? $requerente->outraidentidadegenero : $arr_identidadegenero[$requerente->identidadegenero] }}</dd>

                    <dt class="col-sm-2">Orientação Sexual</dt>
                    <dd class="col-sm-10">{{ $requerente->orientacaosexual == '20' ? $requerente->outraorientacaosexual : $arr_orientacaosexual[$requerente->orientacaosexual] }}</dd>

                    <dt class="col-sm-2">Pessoa com deficiência</dt>
                    <dd class="col-sm-10">{{ $requerente->deficiente == '0' ? "Não" : $requerente->deficiencia }}</dd>

                    <hr>

                    <dt class="col-sm-2">Endereço</dt>
                    <dd class="col-sm-10">{{ $requerente->endereco }}</dd>

                    <dt class="col-sm-2">Nº</dt>
                    <dd class="col-sm-10">{{ $requerente->numero }}</dd>

                    <dt class="col-sm-2">Complemento</dt>
                    <dd class="col-sm-10">{{ $requerente->complemento }}</dd>

                    <dt class="col-sm-2">Bairro</dt>
                    <dd class="col-sm-10">{{ $requerente->bairro }}</dd>

                    <dt class="col-sm-2">Município</dt>
                    <dd class="col-sm-10">{{ $requerente->municipio->nome }}</dd>

                    <dt class="col-sm-2">CEP</dt>
                    <dd class="col-sm-10">{{ $requerente->cep }}</dd>

                    <dt class="col-sm-2">Telefones</dt>
                    <dd class="col-sm-10">{{ $requerente->foneresidencial }} / {{ $requerente->fonecelular }}</dd>

                    <dt class="col-sm-2">E-mail</dt>
                    <dd class="col-sm-10">{{ $requerente->email }}</dd>

                </dl>

                <dl class="row">
                    <dt class="col-sm-2"></dt>
                    <dd class="col-sm-10">
                        <a class="btn btn-outline-secondary" href="{{ route('requerente.index')}}" role="button">Listar</a>
                    </dd>
                </dl>

            </div>
        </div>
    </div>
@endsection
