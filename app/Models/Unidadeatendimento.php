<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Unidadeatendimento extends Model
{
    use HasFactory;

    protected $table = "unidadesatendimentos";

    protected $fillable = [
        'tipounidade_id',
        'nome',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'fone',
        'regional_id',
        'municipio_id',
        'ativo'
    ];

    public function tipounidade()
    {
        return $this->belongsTo(Tipounidade::class);
    }

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }


    public function users ()
    {
        return $this->hasMany(User::class);
    }

    // Retorna a quantidade de Usuários cadastrados na Unidade de Atendimento
    public function qtdusuariosdaunidade($idUnidade)
    {
        $qtd = DB::table('users')->where('unidadeatendimento_id', '=', $idUnidade)->pluck('id')->count();
        return $qtd;
    }


}
