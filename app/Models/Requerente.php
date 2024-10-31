<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerente extends Model
{
    use HasFactory;

    protected $table = "requerentes";

    protected $fillable = [
        'nomecompleto',
        'rg',
        'orgaoexpedidor',
        'cpf',
        'sexobiologico',
        'banco',
        'agencia',
        'conta',
        'contaespecifica',
        'comunidade',
        'outracomunidade',
        'racacor',
        'outraracacor',
        'identidadegenero',
        'outraidentidadegenero',
        'orientacaosexual',
        'outraorientacaosexual',
        'deficiente',
        'deficiencia',
        'nacionalidade',
        'profissao',
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
        'municipio_id',
        'tipounidade_id',
        'unidadeatendimento_id',
        'user_id',
        'status'
    ];


    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }


    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }


    public function tipounidade()
    {
        return $this->belongsTo(Tipounidade::class);
    }


    public function unidadeatendimento()
    {
        return $this->belongsTo(Unidadeatendimento::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalhe()
    {
        return $this->hasOne(Detalherequerente::class);
    }

    public function locacao()
    {
        return $this->hasOne(Locacao::class);
    }

    /*
    // Preparado caso as regras mudem e um requerente possa ter mais de um requerimento
    public function requerimentos()
    {
        return $this->hasMany(Requerimento::class);
    }
    public function locacoes()
    {
        return $this->hasMany(Locacao::class);
    }
    */

}
