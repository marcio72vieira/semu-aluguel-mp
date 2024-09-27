<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipounidade extends Model
{
    use HasFactory;

    protected $table = "tipounidades";

    protected $fillable = [
        'nome',
        'ativo',
    ];

}
