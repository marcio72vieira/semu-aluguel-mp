<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;

    protected $table = "locacoes";

    protected $fillable = [
        'requerente_id',
        'detalherequerente_id',
        'nomeloc',
        'sexoloc',
        'rgloc',
        'orgaoexpedidorloc',
        'cpfloc',
        'nacionalidadeloc',
        'profissaoloc',
        'estadocivilloc',
        'enderecoloc',
        'numeroloc',
        'complementoloc',
        'bairroloc',
        'ceploc',
        'cidadeufloc',
        'enderecoimov',
        'numeroimov',
        'complementoimov',
        'bairroimov',
        'cepimov',
        'cidadeufimov',
        'meseslocacao',
        'mesesextenso',
        'iniciolocacao',
        'fimlocacao',
        'valorlocacao',
        'valorextenso',
        'cidadeforo',
    ];

    public function requerente()
    {
        return $this->belongsTo(Requerente::class);
    }

    public function detalhe()
    {
        return $this->belongsTo(Detalherequerente::class);
    }


}
