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
        Schema::create('requerentes', function (Blueprint $table) {
            $table->id();
            $table->string('nomecompleto');
            $table->string('sexobiologico');
            $table->date('nascimento');
            $table->string('naturalidade');
            $table->string('nacionalidade');
            $table->string('rg');
            $table->string('orgaoexpedidor');
            $table->string('cpf');
            $table->string('banco');
            $table->string('agencia');
            $table->string('conta');
            $table->boolean('contaespecifica');
            $table->string('comunidade');
            $table->string('outracomunidade')->nullable();
            $table->string('racacor');
            $table->string('outraracacor')->nullable();
            $table->string('identidadegenero');
            $table->string('outraidentidadegenero')->nullable();
            $table->string('orientacaosexual');
            $table->string('outraorientacaosexual')->nullable();
            $table->string('deficiente');
            $table->string('deficiencia')->nullable();
            $table->string('escolaridade');
            $table->string('profissao')->nullable();
            $table->string('estadocivil');
            $table->string('endereco');
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cep')->nullable();
            $table->string('foneresidencial')->nullable();
            $table->string('fonecelular')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('regional_id')->constrained('regionais')->onDelete('cascade');
            $table->foreignId('municipio_id')->constrained('municipios')->onDelete('cascade');
            $table->foreignId('tipounidade_id')->constrained('tipounidades')->onDelete('cascade');
            $table->foreignId('unidadeatendimento_id')->constrained('unidadesatendimentos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('estatus'); // Situação do requerimento: 1 - Andamento 2 - Análise 3 - Pendente 4 - Corrigido 5 - Concluído
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requerentes');
    }
};
