<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = "municipios";

    protected $fillable = [
        'nome',
        'ativo',
        'regional_id',
    ];

    public function regional(){
        return $this->belongsTo(Regional::class);
    }

    public function unidadesatendimentos ()
    {
        return $this->hasMany(Unidadeatendimento::class);
    }
}
