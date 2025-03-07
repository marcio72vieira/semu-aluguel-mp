<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    use HasFactory;

    protected $table = "anexos";

    protected $fillable = [
        'nome',
        'url',
        'requerente_id',
    ];

    public function requerente() {
        return $this->belongsTo(Requerente::class);
    }

}
