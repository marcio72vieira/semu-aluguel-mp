<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipodocumento;

class TipodocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Tipodocumento::create([ 'nome' => 'PROCESSO', 'ordem' => 20, 'ativo' => true, ]); */

        Tipodocumento::create([
            'nome' => 'SOLICITAÇÃO DO BENEFÍCIO (OFÍCIO OU OUTROS)',
            'ordem' => 1,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'DOCUMENTO DE IDENTIDADE (RG) E CPF',
            'ordem' => 2,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'COMPROVANTE DE RESIDÊNCIA',
            'ordem' => 3,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'FORMULÁRIO PARA REQUERIMENTO DO BENEFÍCIO (DEVIDAMENTE PREENCHIDO)',
            'ordem' => 4,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'MEDIDA PROTETIVA - FUNDAMENTA DA NO ART 23 DA LEI 11.340/2006',
            'ordem' => 5,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'DECLARAÇÃO DE AUSÊNCIA DE PARENTES NO MUNICÍPIO PARA COMPARTILHAMENTO DO DOMICÍLIO',
            'ordem' => 6,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'DECLARAÇÃO DE VULNERABILIDADE SOCIOECONÔMICA',
            'ordem' => 7,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'CADUNICO (PROGRAMA BOLSA FAMÍLIA)',
            'ordem' => 8,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'CERTIDÃO DE NASCIMENTO DO(S) FILHO(S) CASO POSSUIR',
            'ordem' => 9,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'RELATÓRIO SOCIAL (PREENCHIDO COM DATA E ASSINADO PELA ASSISTENTE SOCIAL)',
            'ordem' => 10,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'CONTA CORRENTE BANCÁRIA: FOTO DO CARTÃO OU PERFIL DA CONTA(APENAS C/C)',
            'ordem' => 11,
            'ativo' => true,
        ]);

        Tipodocumento::create([
            'nome' => 'CONTRATO DE LOCAÇÃO DE ALUGUEL (SOLICITAR APÓS 1º MÊS DE LOCAÇÃO DO IMOVÉL)',
            'ordem' => 12,
            'ativo' => true,
        ]);
    }
}
