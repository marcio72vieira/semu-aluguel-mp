<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    //Obtendo a quantidade de municípios de uma regional, de um outro jeito
    public function qtdunidadeatendimentovinc($id)
    {
        $qtd = DB::table('unidadesatendimentos')->where('municipio_id', '=', $id)->count();

        return $qtd;
    }
}
