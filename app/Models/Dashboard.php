<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dashboard extends Model
{
    use HasFactory;

    public static function totalRegionais()
    {
        return Regional::all()->count();
    }

    public static function totalMunicipios()
    {
        return Municipio::all()->count();
    }

    public static function totalTipounidades()
    {
        return Tipounidade::all()->count();
    }

    public static function totalUnidades()
    {
        return Unidadeatendimento::all()->count();
    }

    public static function totalTipodocumentos()
    {
        return Tipodocumento::all()->count();
    }

    public static function totalRequerentes()
    {
        return Requerente::all()->count();
    }

    public static function totalUsuarios()
    {
        return User::all()->count();
    }

    public static function totalProcessos()
    {
        return Requerente::where('status', '=', 5)->count();
    }

    public static function processos()
    {
        return Processo::orderBy('nomecompleto')->paginate(10);
    }
    

}
