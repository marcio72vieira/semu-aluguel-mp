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
        Schema::create('locadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requerente_id')->constrained('requerentes')->onDelete('cascade');
            $table->foreignId('detalherequerente_id')->constrained('detalherequerentes')->onDelete('cascade');
            $table->string('nome');
            $table->string('rg');
            $table->string('orgaoexpedidor');
            $table->string('cpf');
            $table->string('nacionalidade');
            $table->string('profissao')->nullable();
            $table->string('estadocivil');
            $table->string('endereco');
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cep')->nullable();
            $table->string('cidade');
            $table->string('estado');
            $table->string('enderecoimovel');
            $table->string('numeroimovel')->nullable();
            $table->string('complementoimovel')->nullable();
            $table->string('bairroimovel');
            $table->string('cepimovel')->nullable();
            $table->string('cidadeimovel');
            $table->string('estadoimovel');
            $table->string('meseslocacao');
            $table->string('mesesextenso');
            $table->string('iniciolocacao');
            $table->string('fimlocacao');
            $table->decimal('valorlocacao',12, 2)->default(0);
            $table->string('valorextenso');
            $table->string('cidadeforo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locadores');
    }
};
