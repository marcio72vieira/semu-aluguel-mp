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

    //Obtendo a quantidade de documentos de uma regional, de um outro jeito
    public function qtddocumentosdotipo($id)
    {
        $qtd = DB::table('documentos')->where('tipodocumento_id', '=', $id)->count();

        return $qtd;
    }
}
