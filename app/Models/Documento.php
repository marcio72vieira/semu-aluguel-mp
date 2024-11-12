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

    public function tipodocumento()
    {
        return $this->belongsTo(Tipodocumento::class);
    }

    public function requerente() {
        return $this->belongsTo(Requerente::class);
    }

}
