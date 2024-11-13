<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = "documentos";

    protected $fillable = [
        'ordem',
        'url',
        'tipodocumento_id',
        'requerente_id',
    ];

    // OBS:
    // Inserir campos: aprovado(sim-1/não-0), observacao(Texto explicativo porque não(0) foi aprovado ou Null caso tenha sido aprovado(1)),
    // usuario_id(responspavel pelo check-list, ou seja, do Servidor da SEMU). Na tabea requerente, já possui o usuario_id(responsável pelo envio dos documentos, ou seja, do Assistente Social)

    public function tipodocumento()
    {
        return $this->belongsTo(Tipodocumento::class);
    }

    public function requerente() {
        return $this->belongsTo(Requerente::class);
    }

}
