<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimento extends Model
{
    use HasFactory;

    protected $table = "detalherequerentes";

    protected $fillable = [
        'requerente_id',
        'processojudicial',
        'orgaojudicial',
        'comarca',
        'prazomedidaprotetiva',
        'dataconcessaomedidaprotetiva',
        'medproturgcaminhaprogoficial',
        'medproturgafastamentolar',
        'riscmortvioldomesmoradprotegsigilosa',
        'riscvidaaguardmedproturg',
        'relatodescomprmedproturgagressor',
        'sitvulnerabnaoconsegarcardespmoradia',
        'temrendfamiliardoissalconvivagressor',
        'possuiparenteporeminviavelcompartilhardomicilio',
        'parentesinviavelcompartilhardomicilio',
        'filhosmenoresidade',
        'trabalhaougerarenda',
        'valortrabalhorenda',
        'temcadunico',
        'teminteresformprofisdesenvolvhabilid',
        'apresentoudocumentoidentificacao',
        'cumprerequisitositensnecessarios',
    ];

    public function requerente()
    {
        return $this->belongsTo(Requerente::class);
    }


}
