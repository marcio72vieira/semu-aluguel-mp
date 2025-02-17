<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tipounidade extends Model
{
    use HasFactory;

    protected $table = "tipounidades";

    protected $fillable = [
        'nome',
        'descricao',
        'ativo',
    ];


    public function unidadesatendimentos ()
    {
        return $this->hasMany(Unidadeatendimento::class);
    }

    public function users ()
    {
        return $this->hasMany(User::class);
    }

    //Obtendo a quantidade de municípios de uma regional, de um outro jeito
    public function qtdunidadesatendimento($id)
    {
        $qtd = DB::table('unidadesatendimentos')->where('tipounidade_id', '=', $id)->count();

        return $qtd;
    }

}
