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
            $table->smallInteger('ordem');    // Ordem com que deve ser apresentado para o servidor da SEMU na hora do CheckList
            $table->string('url');
            $table->foreignId('tipodocumento_id')->constrained('tipodocumentos')->onDelete('cascade');
            $table->foreignId('requerente_id')->constrained()->onDelete('cascade');
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
