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
        Schema::create('locacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requerente_id')->constrained('requerentes')->onDelete('cascade');
            $table->foreignId('detalherequerente_id')->constrained('detalherequerentes')->onDelete('cascade');
            $table->string('nomeloc');
            $table->string('sexoloc');
            $table->string('rgloc');
            $table->string('orgaoexpedidorloc');
            $table->string('cpfloc');
            $table->string('nacionalidadeloc');
            $table->string('profissaoloc')->nullable();
            $table->string('estadocivilloc');
            $table->string('enderecoloc');
            $table->string('numeroloc')->nullable();
            $table->string('complementoloc')->nullable();
            $table->string('bairroloc');
            $table->string('ceploc')->nullable();
            $table->string('cidadeufloc');
            $table->string('enderecoimov');
            $table->string('numeroimov')->nullable();
            $table->string('complementoimov')->nullable();
            $table->string('bairroimov');
            $table->string('cepimov')->nullable();
            $table->string('cidadeufimov');
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
        Schema::dropIfExists('locacoes');
    }
};
