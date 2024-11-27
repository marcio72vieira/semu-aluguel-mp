<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tipodocumento extends Model
{
    use HasFactory;

    protected $table = "tipodocumentos";

    protected $fillable = [
        'nome',
        'ordem',
        'ativo',
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    // Obtendo a quantidade de documentos de um determinado tipo. A quantidade diz que aquele tipo de 
    // documento já foi utilizado e portanto não pode seer deletado nunca do banco de dados.
    public function qtddocumentosdotipo($id)
    {
        $qtd = DB::table('documentos')->where('tipodocumento_id', '=', $id)->count();

        return $qtd;
    }
}
