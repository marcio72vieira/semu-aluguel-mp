@extends('layout.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">REQUERENTE - visualizar</h2>
            {{-- <ol class="mt-3 mb-3 breadcrumb ms-auto">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Requerentes</a></li>
                <li class="breadcrumb-item active">Requerente</li>
            </ol> --}}
        </div>

        <div class="row">
            <x-alert />

            {{-- Este componente será acionado sempre que houver uma erro de exceção em: store, update ou delete --}}
            <x-errorexception />

            <div class="col-5">
                <div class="mb-4 shadow card border-light">
                    <div class="gap-2 card-header hstack">
                        <span class="p-2 small"><strong> INFORMAÇÕES DA REQUERENTE </strong></span>
                    </div>

                    <div class="card-body" style ="background-image: url('{{ asset("images/background_06_opct5.png")}}'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-size: 100% 100%;">


                        <dl class="row">

                            {{-- <dt class="col-sm-4">Id</dt>
                            <dd class="col-sm-8">{{ $requerente->id }}</dd> --}}

                            <dt class="col-sm-4">Nome Completo</dt>
                            <dd class="col-sm-8">{{ $requerente->nomecompleto }}</dd>

                            <dt class="col-sm-4">Sexo Biológico</dt>
                            <dd class="col-sm-8">{{ $requerente->sexobiologico }}</dd>

                            <dt class="col-sm-4">Data de nascimento</dt>
                            <dd class="col-sm-8">{{ mrc_turn_data($requerente->nascimento) }}</dd>

                            <dt class="col-sm-4">Naturalidade</dt>
                            <dd class="col-sm-8">{{ $requerente->naturalidade }}</dd>

                            <dt class="col-sm-4" style="margin-bottom:30px;">Nacionalidade</dt>
                            <dd class="col-sm-8">{{ $requerente->nacionalidade }}</dd>

                            <dt class="col-sm-4">RG</dt>
                            <dd class="col-sm-8">{{ $requerente->rg }}</dd>

                            <dt class="col-sm-4">Ógão Expedidor</dt>
                            <dd class="col-sm-8">{{ $requerente->orgaoexpedidor }}</dd>

                            <dt class="col-sm-4">CPF</dt>
                            <dd class="col-sm-8">{{ $requerente->cpf }}</dd>

                            <dt class="col-sm-4">Banco</dt>
                            <dd class="col-sm-8">{{ $requerente->banco }}</dd>

                            <dt class="col-sm-4">Agência</dt>
                            <dd class="col-sm-8">{{ $requerente->agencia }}</dd>

                            <dt class="col-sm-4">Conta Corrente</dt>
                            <dd class="col-sm-8">{{ $requerente->conta }}</dd>

                            <dt class="col-sm-4" style="margin-bottom:30px;">Conta espcífica</dt>
                            <dd class="col-sm-8">{{ $requerente->contaespecifica == "1" ? "Com movimento" : "Sem movimento" }}</dd>

                            <dt class="col-sm-4">Comunidade</dt>
                            {{--  <dd class="col-sm-8">{{ $comunidades[$requerente->comunidade] }} {{ $requerente->comunidade == '8' ? $requerente->outracomunidade : '' }}</dd> --}}
                            <dd class="col-sm-8">{{ $requerente->comunidade == '20' ? $requerente->outracomunidade : $arr_comunidade[$requerente->comunidade] }}</dd>

                            <dt class="col-sm-4">Cor/Raça/Etnia</dt>
                            <dd class="col-sm-8">{{ $requerente->racacor == '20' ? $requerente->outraracacor : $arr_racacor[$requerente->racacor] }}</dd>

                            <dt class="col-sm-4">Identidade de Gênero</dt>
                            <dd class="col-sm-8">{{ $requerente->identidadegenero == '20' ? $requerente->outraidentidadegenero : $arr_identidadegenero[$requerente->identidadegenero] }}</dd>

                            <dt class="col-sm-4">Orientação Sexual</dt>
                            <dd class="col-sm-8">{{ $requerente->orientacaosexual == '20' ? $requerente->outraorientacaosexual : $arr_orientacaosexual[$requerente->orientacaosexual] }}</dd>

                            <dt class="col-sm-4" style="margin-bottom:30px;">Pessoa com deficiência</dt>
                            <dd class="col-sm-8">{{ $requerente->deficiente == '0' ? "Não" : $requerente->deficiencia }}</dd>

                            <dt class="col-sm-4">Escolaridade</dt>
                            <dd class="col-sm-8">{{ $arr_escolaridade[$requerente->escolaridade] }}</dd>

                            <dt class="col-sm-4">Profissão</dt>
                            <dd class="col-sm-8">{{ $requerente->profissao }}</dd>

                            <dt class="col-sm-4" style="margin-bottom:30px;">Estado Civil</dt>
                            <dd class="col-sm-8">{{ $arr_estadocivil[$requerente->estadocivil] }}</dd>

                            <dt class="col-sm-4">Regional</dt>
                            <dd class="col-sm-8">{{ $requerente->municipio->regional->nome }}</dd>

                            <dt class="col-sm-4">Município</dt>
                            <dd class="col-sm-8">{{ $requerente->municipio->nome }}</dd>

                            <dt class="col-sm-4">Tipo Unidade</dt>
                            <dd class="col-sm-8">{{ $requerente->tipounidade->nome}}</dd>

                            <dt class="col-sm-4">Unidade de Atendimento</dt>
                            <dd class="col-sm-8">{{ $requerente->unidadeatendimento->nome }}</dd>

                            <dt class="col-sm-4">Responsável</dt>
                            <dd class="col-sm-8">{{ $requerente->user->nomecompleto }}</dd>
                            <dt class="col-sm-4">Endereço</dt>
                            <dd class="col-sm-8">{{ $requerente->endereco }}</dd>

                            <dt class="col-sm-4">Nº</dt>
                            <dd class="col-sm-8">{{ $requerente->numero }}</dd>

                            <dt class="col-sm-4">Complemento</dt>
                            <dd class="col-sm-8">{{ $requerente->complemento }}</dd>

                            <dt class="col-sm-4">Bairro</dt>
                            <dd class="col-sm-8">{{ $requerente->bairro }}</dd>

                            <dt class="col-sm-4">Município</dt>
                            <dd class="col-sm-8">{{ $requerente->municipio->nome }}</dd>

                            <dt class="col-sm-4">CEP</dt>
                            <dd class="col-sm-8">{{ $requerente->cep }}</dd>

                            <dt class="col-sm-4">Telefones</dt>
                            <dd class="col-sm-8">{{ $requerente->foneresidencial }} / {{ $requerente->fonecelular }}</dd>

                            <dt class="col-sm-4">E-mail</dt>
                            <dd class="col-sm-8">{{ $requerente->email }}</dd>

                        </dl>

                        {{-- <dl class="row">
                            <dt class="col-sm-4"></dt>
                            <dd class="col-sm-8">
                                <a class="btn btn-outline-secondary" href="{{ route('requerente.index')}}" role="button">Listar</a>
                                <a href="{{ route('requerente.relpdfrequerente', ['requerente' => $requerente->id]) }}" class="p-2 btn btn-danger btn-sm" target="_blank">
                                    <i class="fa-solid fa-file-pdf"></i> Requerimento
                                </a>
                            </dd>
                        </dl> --}}

                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="mb-4 shadow card border-light">
                    <div class="gap-2 card-header hstack">
                        <span class="p-2 small"><strong>DETALHES DO REQUERIMENTO </strong></span>
                    </div>

                    <div class="card-body" style ="background-image: url('{{ asset("images/background_06_opct5.png")}}'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-size: 100% 100%;">

                        <dl class="row">

                            <dt class="col-sm-4">Processo Judicial</dt>
                            <dd class="col-sm-8">{{ $requerente->detalhe->processojudicial }}</dd>

                            <dt class="col-sm-4">Órgao Judicial</dt>
                            <dd class="col-sm-8">{{ $requerente->detalhe->orgaojudicial }}</dd>

                            <dt class="col-sm-4" style="margin-bottom:30px;">Comarca</dt>
                            <dd class="col-sm-8">{{ $requerente->detalhe->comarca }}</dd>

                            <dt class="col-sm-4">Prazo da medida protetiva (em dias)</dt>
                            <dd class="col-sm-8">{{ mrc_turn_data($requerente->detalhe->prazomedidaprotetiva) }}</dd>

                            <dt class="col-sm-4" style="margin-bottom:100px;">Data em que foi concedida</dt>
                            <dd class="col-sm-8">{{ mrc_turn_data($requerente->detalhe->dataconcessaomedidaprotetiva) }}</dd>


                            {{-- item 2.6.1 --}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente foi atendida com a medida protetiva de urgência de encaminhamento a programa oficial ou comunitário de proteção ou atendimento? (art. 23, I, Lei 11.340/2006) *</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->medproturgcaminhaprogoficial == "1" ? "sim" : "não" }}</dd>

                            {{-- item 2.6.2 --}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente foi atendida com a medida protetiva de urgência de afastamento do lar?  (art. 23, III, Lei 11.340/2006) *</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->medproturgafastamentolar == "1" ? "sim" : "não" }}</dd>

                            {{-- item 2.6.3 --}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente encontra-se em situação de risco de vida iminente em razão de violência doméstica, carecendo de moradia protegida em caráter sigiloso?</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->riscmortvioldomesmoradprotegsigilosa == "1" ? "sim" : "não" }}</dd>

                            {{-- item 2.6.4 --}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente encontra-se em situação de risco de morte, aguardando medida protetiva de urgência?</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->riscvidaaguardmedproturg == "1" ? "sim" : "não"  }}</dd>

                            {{-- item 2.6.5--}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente encontra-se em situação de risco de morte e relata descumprimento de medida protetiva de urgência pelo agressor, necessitando de proteção até que se efetive a prisão deste?</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->relatodescomprmedproturgagressor == "1" ? "sim" : "não"  }}</dd>

                            {{-- item 2.6.6--}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente está em situação de vulnerabilidade, de forma a não conseguir arcar com as despesas de moradia? *</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->sitvulnerabnaoconsegarcardespmoradia == "1" ? "sim" : "não"  }}</dd>

                            {{-- item 2.6.7--}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">requerente tem renda familiar de no máximo 02 salários, mesmo durante o convívio com o agressor? *</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->temrendfamiliardoissalconvivagressor == "1" ? "sim" : "não"  }}</dd>

                             {{-- item 2.6.8--}}
                             <dt class="col-sm-11" style="margin-bottom:15px;">
                                {{-- A requerente não possui pais, avós, filhos ou netos maiores de idade, no mesmo município de sua residência? Se sim, quais* --}}
                                A requerente possui parentes em linha reta no município, porém não é viável o compartilhamento de domicílio nos termos do art 1º, VI, do Decreto 37.341, de 23 de dezembro de 2021 ? *
                                @if ($requerente->detalhe->possuiparenteporeminviavelcompartilhardomicilio == "1")
                                    <br>
                                    <label style="color: green; font-size: 20px;">- {{ $requerente->detalhe->parentesinviavelcompartilhardomicilio }}</label>
                                @endif
                             </dt>
                            <dd class="col-sm-1" style="text-align: left">{{ $requerente->detalhe->possuiparenteporeminviavelcompartilhardomicilio == "1" ? "sim" : "não" }}</dd>


                            {{-- item 2.6.9--}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente possui filhos menores de idade?</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->filhosmenoresidade == "1" ? "sim" : "não"  }}</dd>


                            {{-- item 2.6.10--}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente está trabalhando ou possui alguma forma de gerar renda no momento? Se sim, valor
                                @if ($requerente->detalhe->trabalhaougerarenda == "1")
                                    <br>
                                    <label style="color: green; font-size: 20px;">- R$ {{ mrc_turn_value($requerente->detalhe->valortrabalhorenda) }}</label>
                                @endif
                            </dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->trabalhaougerarenda == "1" ? "sim" : "não"  }}</dd>


                            {{-- item 2.6.11--}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente está cadastrada no Cadastro Único (CADUNICO)? *
                                @if ($requerente->detalhe->temcadunico == "1")
                                    <br>
                                    <label style="color: green; font-size: 20px;">- R$ {{ mrc_turn_value($requerente->detalhe->valortemcadunico) }}</label>
                                @endif
                            </dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->temcadunico == "1" ? "sim" : "não"  }}</dd>

                            {{-- item 2.6.12--}}
                            <dt class="col-sm-11" style="margin-bottom:15px;">A requerente tem interesse de participar de formações para qualificação profissional e de desenvolvimento de habilidades (cursos, oficinas, entre outros)?</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->teminteresformprofisdesenvolvhabilid == "1" ? "sim" : "não"  }}</dd>

                            {{-- item 2.6.13--}}
                            <dt class="col-sm-11" style="margin-bottom:50px;">A requerente apresentou documento de identificação?</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->apresentoudocumentoidentificacao == "1" ? "sim" : "não"  }}</dd>

                            {{-- item 2.6.14--}}
                            <dt class="col-sm-11" style="margin-bottom:35px;">A requerente cumpre os requisitos previstos nos itens marcados com (*), necessários para concessão do benefício?</dt>
                            <dd class="col-sm-1">{{ $requerente->detalhe->cumprerequisitositensnecessarios == "1" ? "sim" : "não"  }}</dd>

                        </dl>

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="mb-4 shadow card border-light">
                    <div class="gap-2 card-header hstack">
                        <span class="p-2 small"><strong> INFORMAÇÕES DA LOCAÇÃO </strong></span>
                    </div>

                    <div class="card-body">

                        <dl class="row">
                                {{-- Dados do Locatário --}}
                                <span class="p-2 small" style="margin-top: 15px; margin-left: 5px"><strong> Dados do Locatário(a) </strong></span>
                                <hr>

                                <dt class="col-sm-2">Nome do Locatário</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->nomeloc }}</dd>

                                <dt class="col-sm-1">RG</dt>
                                <dd class="col-sm-2">{{ $requerente->locacao->rgloc }} {{ $requerente->locacao->orgaoexpedidorloc }}</dd>

                                <dt class="col-sm-1">CPF</dt>
                                <dd class="col-sm-2">{{ $requerente->locacao->cpfloc }}</dd>

                                <dt class="col-sm-2">Nacionalidade</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->nacionalidadeloc }}</dd>

                                <dt class="col-sm-1">Profissão</dt>
                                <dd class="col-sm-2">{{ $requerente->locacao->profissaoloc }}</dd>

                                <dt class="col-sm-1">Estado Civil</dt>
                                <dd class="col-sm-2">{{ $arr_estadocivilloc[$requerente->locacao->estadocivilloc] }}</dd>

                                <dt class="col-sm-2">Endereço</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->enderecoloc }}</dd>

                                <dt class="col-sm-1">Nº</dt>
                                <dd class="col-sm-2">{{ $requerente->locacao->numeroloc }}</dd>

                                <dt class="col-sm-1">Complemento</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->complementoloc }}</dd>

                                <dt class="col-sm-2">Bairro</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->bairroloc }}</dd>

                                <dt class="col-sm-1">CEP</dt>
                                <dd class="col-sm-2">{{ $requerente->locacao->ceploc }}</dd>

                                <dt class="col-sm-1">Cidade</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->cidadeufloc }}</dd>


                                {{-- Dados do Imóvel --}}

                                <span class="p-2 small" style="margin-top: 15px; margin-left: 5px"><strong> Dados do Imóvel </strong></span>
                                <hr>

                                <dt class="col-sm-2">Endereço</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->enderecoimov }}</dd>

                                <dt class="col-sm-1">Nº</dt>
                                <dd class="col-sm-2">{{ $requerente->locacao->numeroimov }}</dd>

                                <dt class="col-sm-1">Complemento</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->complementoimov }}</dd>

                                <dt class="col-sm-2">Bairro</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->bairroimov }}</dd>

                                <dt class="col-sm-1">CEP</dt>
                                <dd class="col-sm-2">{{ $requerente->locacao->cepimov }}</dd>

                                <dt class="col-sm-1">Cidade</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->cidadeufimov }}</dd>

                                <dt class="col-sm-2">Meses de Alocação</dt>
                                <dd class="col-sm-3">{{ $requerente->locacao->meseslocacao }} ({{ $requerente->locacao->mesesextenso }})</dd>

                                <dt class="col-sm-1">Data Início</dt>
                                <dd class="col-sm-2">{{ mrc_turn_data($requerente->locacao->iniciolocacao) }}</dd>

                                <dt class="col-sm-1">Data Final</dt>
                                <dd class="col-sm-3">{{ mrc_turn_data($requerente->locacao->fimlocacao) }}</dd>

                                <dt class="col-sm-2">Valor (R$)</dt>
                                <dd class="col-sm-3">{{ mrc_turn_value($requerente->locacao->valorlocacao) }} ({{ $requerente->locacao->valorextenso }})</dd>

                                <dt class="col-sm-1">Cidade / Foro</dt>
                                <dd class="col-sm-2">{{ $requerente->locacao->cidadeforo }}</dd>

                        </dl>

                        <dl class="row">
                            <dt class="col-sm-2"></dt>
                            <dd class="col-sm-3">
                                <a class="btn btn-outline-secondary" href="{{ route('requerente.index')}}" role="button">Retornar</a>

                                {{-- <a href="{{ route('requerente.edit', ['requerente' => $requerente->id]) }}" class="p-2 btn btn-warning btn-sm md-2">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a> --}}

                                {{-- <a href="{{ route('requerente.relpdfrequerente', ['requerente' => $requerente->id]) }}" class="p-2 btn btn-danger btn-sm" target="_blank">
                                    <i class="fa-solid fa-file-pdf"></i> Anexos
                                </a> --}}
                            </dd>
                        </dl>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
