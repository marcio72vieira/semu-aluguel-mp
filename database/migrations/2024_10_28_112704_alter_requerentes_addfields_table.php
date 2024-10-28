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
        Schema::table('requerentes', function(Blueprint $table){
            $table->string('nacionalidade')->after('deficiencia');
            $table->string('profissao')->after('nacionalidade')->nullable();
            $table->string('estadocivil')->after('profissao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requerentes', function(Blueprint $table){
            $table->dropColumn('nacionalidade');
            $table->dropColumn('profissao');
            $table->string('estadocivil');
        });
    }
};
