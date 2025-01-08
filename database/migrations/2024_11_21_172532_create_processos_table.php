<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Adicionar todos os campos para necessários para quaisquer pesquisas para a confecção do dashboard. Não esquecer de calcular a idade das requerentes com base na data de nascimento
        // Falta acrescentar os campos data de nascimeno da requerene, o campo calculado idade (com base na data de nascimento) (bairro_id e bairro a ser implementado)

        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->string('url');

            // Campos referente ao cadastro da Requerente
            $table->integer('requerente_id')->nullable();
            $table->string('nomecompleto')->nullable();
            $table->string('sexobiologico')->nullable();
            $table->date('nascimento')->nullable();
            $table->string('naturalidade')->nullable();
            $table->string('nacionalidade')->nullable();

            $table->string('rg')->nullable();
            $table->string('orgaoexpedidor')->nullable();
            $table->string('cpf')->nullable();
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('conta')->nullable();
            $table->integer('contaespecifica_id')->nullable();
            $table->string('contaespecifica')->nullable();

            $table->integer('comunidade_id')->nullable();
            $table->string('comunidade')->nullable();
            $table->string('outracomunidade')->nullable();
            $table->integer('racacor_id')->nullable();
            $table->string('racacor')->nullable();
            $table->string('outraracacor')->nullable();
            $table->integer('identidadegenero_id')->nullable();
            $table->string('identidadegenero')->nullable();
            $table->string('outraidentidadegenero')->nullable();
            $table->integer('orientacaosexual_id')->nullable();
            $table->string('orientacaosexual')->nullable();
            $table->string('outraorientacaosexual')->nullable();
            $table->integer('deficiente_id')->nullable();
            $table->string('deficiente')->nullable();
            $table->string('deficiencia')->nullable();

            $table->integer('escolaridade_id')->nullable();
            $table->string('escolaridade')->nullable();
            $table->string('profissao')->nullable();
            $table->integer('estadocivil_id')->nullable();
            $table->string('estadocivil')->nullable();

            $table->integer('regional_id')->nullable();
            $table->string('regional')->nullable();
            $table->integer('municipio_id')->nullable();
            $table->string('municipio')->nullable();
            $table->integer('tipounidade_id')->nullable();
            $table->string('tipounidade')->nullable();
            $table->integer('unidadeatendimento_id')->nullable();
            $table->string('unidadeatendimento')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('foneresidencial')->nullable();
            $table->string('fonecelular')->nullable();
            $table->string('email')->nullable();
            $table->date('datacadastro')->nullable();           //data de cadastro da requerente $requetente->created_at

            // campos referente aos detalhes do requerimento
            $table->string('processojudicial')->nullable();
            $table->string('orgaojudicial')->nullable();
            $table->string('comarca')->nullable();
            $table->integer('prazomedidaprotetiva')->nullable();
            $table->date('dataconcessaomedidaprotetiva')->nullable();

            $table->tinyInteger('medproturgcaminhaprogoficial_id')->nullable();
            $table->tinyText('medproturgcaminhaprogoficial')->nullable();

            $table->tinyInteger('medproturgafastamentolar_id')->nullable();
            $table->tinyText('medproturgafastamentolar')->nullable();

            $table->tinyInteger('riscmortvioldomesmoradprotegsigilosa_id')->nullable();
            $table->tinyText('riscmortvioldomesmoradprotegsigilosa')->nullable();

            $table->tinyInteger('riscvidaaguardmedproturg_id')->nullable();
            $table->tinyText('riscvidaaguardmedproturg')->nullable();

            $table->tinyInteger('relatodescomprmedproturgagressor_id')->nullable();
            $table->tinyText('relatodescomprmedproturgagressor')->nullable();

            $table->tinyInteger('sitvulnerabnaoconsegarcardespmoradia_id')->nullable();
            $table->tinyText('sitvulnerabnaoconsegarcardespmoradia')->nullable();

            $table->tinyInteger('temrendfamiliardoissalconvivagressor_id')->nullable();
            $table->tinyText('temrendfamiliardoissalconvivagressor')->nullable();

            $table->tinyInteger('possuiparenteporeminviavelcompartilhardomicilio_id')->nullable();
            $table->tinyText('possuiparenteporeminviavelcompartilhardomicilio')->nullable();
            $table->string('parentesinviavelcompartilhardomicilio')->nullable();

            $table->tinyInteger('filhosmenoresidade_id')->nullable();
            $table->tinyText('filhosmenoresidade')->nullable();

            $table->tinyInteger('trabalhaougerarenda_id')->nullable();
            $table->tinyText('trabalhaougerarenda')->nullable();
            $table->decimal('valortrabalhorenda',12, 2)->default(0)->nullable();

            $table->tinyInteger('temcadunico_id')->nullable();
            $table->tinyText('temcadunico')->nullable();
            $table->decimal('valortemcadunico',12,2)->nullable();

            $table->tinyInteger('teminteresformprofisdesenvolvhabilid_id')->nullable();
            $table->tinyText('teminteresformprofisdesenvolvhabilid')->nullable();

            $table->tinyInteger('apresentoudocumentoidentificacao_id')->nullable();
            $table->tinyText('apresentoudocumentoidentificacao')->nullable();

            $table->tinyInteger('cumprerequisitositensnecessarios_id')->nullable();
            $table->tinyText('cumprerequisitositensnecessarios')->nullable();

            // campos referene o Assistente Social e ao Servidor da SEMU
            $table->integer('assistente_id')->nullable();       // $requerente->user->id funcionario da semu
            $table->string('assistente')->nullable();           // $requerente->user->nomecompleto
            $table->integer('funcionariosemu_id')->nullable();  //$documento->user->id
            $table->string('funcionario')->nullable();          //$documento->user->nomecompleto .91 camppos

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processos');
    }
};
