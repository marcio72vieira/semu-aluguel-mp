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
        Schema::create('requerimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requerente_id')->constrained('requerentes')->onDelete('cascade');
            $table->string('processojudicial');
            $table->string('orgaojudicial');
            $table->string('comarca');
            $table->date('prazomedidaprotetiva');
            $table->date('dataconcessaomedidaprotetiva');
            $table->boolean('medproturgcaminhaprogoficial');
            $table->boolean('medproturgafastamentolar');
            $table->boolean('riscmortvioldomesmoradprotegsigilosa');
            $table->boolean('riscvidaaguardmedproturg');
            $table->boolean('relatodescomprmedproturgagressor');
            $table->boolean('sitvulnerabnaoconsegarcardespmoradia');
            $table->boolean('temrendfamiliardoissalconvivagressor');
            $table->boolean('paiavofilhonetomaiormesmomunicipresid');
            $table->string('parentesmesmomunicipioresidencia')->nullable();
            $table->boolean('filhosmenoresidade');
            $table->boolean('trabalhaougerarenda');
            $table->decimal('valortrabalhorenda',12, 2)->default(0)->nullable();
            $table->boolean('temcadunico');
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
        Schema::dropIfExists('requerimentos');
    }
};
