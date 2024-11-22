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
        'nomecompleto',
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
        'sexobiologico',
        'orientacaosexual_id',
        'orientacaosexual',
        'outraorientacaosexual',
        'deficiente_id',
        'deficiente',
        'deficiencia',
        'nacionalidade',
        'profissao',
        'estadocivil_id',
        'estadocivil',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'foneresidencial',
        'fonecelular',
        'email',
        'regional_id',
        'regional',
        'municipio_id',
        'municipio',
        'tipounidade_id',
        'tipounidade',
        'unidadeatendimento_id',
        'unidadeatendimento',
        'datacadastro',
        'processojudicial',
        'orgaojudicial',
        'comarca',
        'prazomedidaprotetiva',
        'dataconcessaomedidaprotetiva',
        'medproturgcaminhaprogoficial',
        'medproturgafastamentolar',
        'riscmortvioldomesmoradprotegsigilosa',
        'riscvidaaguardmedproturg',
        'relatodescomprmedproturgagressor',
        'sitvulnerabnaoconsegarcardespmoradia',
        'temrendfamiliardoissalconvivagressor',
        'paiavofilhonetomaiormesmomunicipresid',
        'parentesmesmomunicipioresidencia',
        'filhosmenoresidade',
        'trabalhaougerarenda',
        'valortrabalhorenda',
        'temcadunico',
        'teminteresformprofisdesenvolvhabilid',
        'apresentoudocumentoidentificacao',
        'cumprerequisitositensnecessarios',
        'assistente_id',
        'assistente',
        'funcionariosemu_id',
        'funcionario',
    ];

}
