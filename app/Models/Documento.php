<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = "documentos";

    protected $fillable = [
        'ordem',                // Ordem com que deve ser apresentado para o servidor da SEMU na hora do CheckList
        'url',                  // Caminho onde se encontra localizado o arquivo físico no servidor
        'tipodocumento_id',
        'aprovado',             // Aprovado 1 ou 0
        'observacao',
        'requerente_id',        // Através da relação com User (no model Requerente), é possível saber o Assistente Social responsavel pelo cadastro dos documentos
        'user_id',              // Responsavel pela análise dos documentos

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

    // Usuário, Servidor da SEMU, responsável pela avaliação
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
