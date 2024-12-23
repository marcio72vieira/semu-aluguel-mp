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
        'contaespecifica',
        
        'comunidade_id',
        'comunidade',
        'outracomunidade',
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

        'paiavofilhonetomaiormesmomunicipresid_id',
        'paiavofilhonetomaiormesmomunicipresid',
        'parentesmesmomunicipioresidencia',

        'filhosmenoresidade_id',
        'filhosmenoresidade',

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

        'assistente_id',
        'assistente',
        'funcionariosemu_id',
        'funcionario',  //91 campos
    ];

}
