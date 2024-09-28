<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function tipounidade(){
        return $this->belongsTo(Tipounidade::class);
    }

    public function regional(){
        return $this->belongsTo(Regional::class);
    }

    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }

}
