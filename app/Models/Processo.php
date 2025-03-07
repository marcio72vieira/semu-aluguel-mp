<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    use HasFactory;

    protected $table = "processos";

    protected $fillable = [
        'url',
        'requerente_id',
        'nomecompleto',
        'sexobiologico',
        'nascimento',
        'naturalidade',
        'nacionalidade',

        'rg',
        'orgaoexpedidor',
        'cpf',
        'banco',
        'agencia',
        'conta',
        'contaespecifica_id',   // recebe 0 ou 1
        'contaespecifica',      // recebe "não ou sim"

        'comunidade_id',        // recebe o valor numérico da comunidade
        'comunidade',           // recebe o valor string da comunidade
        'outracomunidade',      // recebe o valor string da outracomunidade
        'racacor_id',
        'racacor',
        'outraracacor',
        'identidadegenero_id',
        'identidadegenero',
        'outraidentidadegenero',
        'orientacaosexual_id',
        'orientacaosexual',
        'outraorientacaosexual',
        'deficiente_id',
        'deficiente',
        'deficiencia',

        'escolaridade_id',
        'escolaridade',
        'profissao',
        'estadocivil_id',
        'estadocivil',

        'regional_id',
        'regional',
        'municipio_id',
        'municipio',
        'tipounidade_id',
        'tipounidade',
        'tipounidadedescricao',
        'unidadeatendimento_id',
        'unidadeatendimento',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'foneresidencial',
        'fonecelular',
        'email',
        'datacadastro',

        'processojudicial',
        'orgaojudicial',
        'comarca',
        'prazomedidaprotetiva',
        'dataconcessaomedidaprotetiva',

        'medproturgcaminhaprogoficial_id',
        'medproturgcaminhaprogoficial',

        'medproturgafastamentolar_id',
        'medproturgafastamentolar',

        'riscmortvioldomesmoradprotegsigilosa_id',
        'riscmortvioldomesmoradprotegsigilosa',

        'riscvidaaguardmedproturg_id',
        'riscvidaaguardmedproturg',

        'relatodescomprmedproturgagressor_id',
        'relatodescomprmedproturgagressor',

        'sitvulnerabnaoconsegarcardespmoradia_id',
        'sitvulnerabnaoconsegarcardespmoradia',

        'temrendfamiliardoissalconvivagressor_id',
        'temrendfamiliardoissalconvivagressor',

        'possuiparenteporeminviavelcompartilhardomicilio_id',
        'possuiparenteporeminviavelcompartilhardomicilio',
        'parentesinviavelcompartilhardomicilio',

        'filhosmenoresidade_id',
        'filhosmenoresidade',
        'quantidadefilhosmenores',

        'trabalhaougerarenda_id',
        'trabalhaougerarenda',
        'valortrabalhorenda',

        'temcadunico_id',
        'temcadunico',
        'valortemcadunico',

        'teminteresformprofisdesenvolvhabilid_id',
        'teminteresformprofisdesenvolvhabilid',

        'apresentoudocumentoidentificacao_id',
        'apresentoudocumentoidentificacao',

        'cumprerequisitositensnecessarios_id',
        'cumprerequisitositensnecessarios',

        'assistente_id',        // Assistente social responsável pelo cadastro
        'assistente',
        'funcionariosemu_id',   // Funcionario da SEMU responsavel pela análise e consequente geração do processo
        'funcionario',          //91 campos
    ];

}
