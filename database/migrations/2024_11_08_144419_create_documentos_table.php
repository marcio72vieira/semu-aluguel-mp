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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('ordem');                                          // Ordem com que deve ser apresentado para o servidor da SEMU na hora do CheckList
            $table->string('url');
            $table->foreignId('tipodocumento_id')->constrained('tipodocumentos')->onDelete('cascade');
            $table->boolean('aprovado')->default(1);
            $table->text('observacao')->nullable();
            $table->boolean('corrigido')->nullable();
            $table->foreignId('requerente_id')->constrained()->onDelete('cascade'); // Através destte campo, devido ao seu relacionamento é possível sabe quem é o Assistente Social que cadstrou os docuemntos
            $table->foreignId('user_id')->constrained()->onDelete('cascade');       // Através destte campo, devido ao seu relacionamento é possível sabe quem é o Servidor da Semu responsável pelo checklist
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
