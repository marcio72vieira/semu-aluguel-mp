@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">UNIDADE DE ATENDIMENTO -  visualizar</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Unidade de Atendimento</a></li>
                <li class="breadcrumb-item active">Unidade de Atendimento</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small p-2"><strong> Detalhes </strong></span>
            </div>

            <div class="card-body">

                <dl class="row">

                    <dt class="col-sm-2">Id</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->id }}</dd>

                    <dt class="col-sm-2">Tipo</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->tipounidade->nome }}</dd>

                    <dt class="col-sm-2">Nome</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->nome }}</dd>

                    <dt class="col-sm-2">Endereço</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->endereco }}</dd>

                    <dt class="col-sm-2">Nº</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->numero }}</dd>

                    <dt class="col-sm-2">Complemento</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->complemento }}</dd>

                    <dt class="col-sm-2">Bairro</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->bairro }}</dd>

                    <dt class="col-sm-2">CEP</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->cep }}</dd>

                    <dt class="col-sm-2">Telefone</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->fone }}</dd>

                    <dt class="col-sm-2">Regional</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->regional->nome }}</dd>

                    <dt class="col-sm-2">Município</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->municipio->nome }}</dd>

                    <dt class="col-sm-2">Tipo</dt>
                    <dd class="col-sm-10">{{ $unidadeatendimento->tipo == 1 ? 'Sim' : 'Não' }}</dd>

                </dl>

                <dl class="row">
                    <dt class="col-sm-2"></dt>
                    <dd class="col-sm-10">
                        <a class="btn btn-outline-secondary" href="{{ route('unidadeatendimento.index')}}" role="button">Listar</a>
                    </dd>
                </dl>

            </div>
        </div>
    </div>
@endsection
