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
        Schema::create('detalherequerentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requerente_id')->constrained('requerentes')->onDelete('cascade');
            $table->string('processojudicial');
            $table->string('orgaojudicial');
            $table->string('comarca');
            $table->integer('prazomedidaprotetiva');
            $table->date('dataconcessaomedidaprotetiva');
            $table->boolean('medproturgcaminhaprogoficial');
            $table->boolean('medproturgafastamentolar');
            $table->boolean('riscmortvioldomesmoradprotegsigilosa');
            $table->boolean('riscvidaaguardmedproturg');
            $table->boolean('relatodescomprmedproturgagressor');
            $table->boolean('sitvulnerabnaoconsegarcardespmoradia');
            $table->boolean('temrendfamiliardoissalconvivagressor');
            $table->boolean('possuiparenteporeminviavelcompartilhardomicilio');
            $table->string('parentesinviavelcompartilhardomicilio')->nullable();
            $table->boolean('filhosmenoresidade');
            $table->integer('quantidadefilhosmenores');
            $table->boolean('trabalhaougerarenda');
            $table->decimal('valortrabalhorenda',12, 2)->default(0)->nullable();
            $table->boolean('temcadunico');
            $table->decimal('valortemcadunico',12, 2)->default(0)->nullable();
            $table->boolean('teminteresformprofisdesenvolvhabilid');
            $table->boolean('apresentoudocumentoidentificacao');
            $table->boolean('cumprerequisitositensnecessarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalherequerentes');
    }
};
