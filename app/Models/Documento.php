<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    
    public static function documentosexigidos($idRequerente)
    {
        // Recuperando só os id's das collections(pluck) e de forma única, sem repetição(unique)
        $tiposdocumentosexigidos = Tipodocumento::where('ativo', '=', 1)->pluck('id')->unique()->count();
        $documentosanexados = Documento::where('requerente_id', '=', $idRequerente)->pluck('tipodocumento_id')->unique()->count();
        
        if($documentosanexados < $tiposdocumentosexigidos){
            return true;
        }else{
            return false;
        }
    }
    
    /* 
    //Obtendo a quantidade de documentos de uma requerente, para determinar o status(andamento, analise, pendente etc... )
    public static function qtddocumentosrequerente($idRequerente)
    {
        // Recupera a quantidade de docuemntos exigidos para análise
        $documentosExigidos = DB::table('tipodocumentos')->where('ativo', '=', 1)->count();
        // Recuoera todos os documentos cadastrados do requerente
        $qtdDocs = DB::table('documentos')->where('requerente_id', '=', $idRequerente)->count();
        // Verifica se a quantidade de documento da requernete é igual ou maior a quantidade de documentos exigidos para análise
        if($qtdDocs >= $documentosExigidos){ return true; }else{ return false; }
    }
     */
}
