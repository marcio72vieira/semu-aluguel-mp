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

    public static function totalRequerentesAndamento()
    {
        return Requerente::where('estatus', '=', '1')->count();
    }

    public static function totalRequerentesAnalise()
    {
        return Requerente::where('estatus', '=', '2')->count();
    }

    public static function totalRequerentesPendente()
    {
        return Requerente::where('estatus', '=', '3')->count();
    }

    public static function totalRequerentesCorrigido()
    {
        return Requerente::where('estatus', '=', '4')->count();
    }

    public static function totalRequerentesConcluido()
    {
        return Requerente::where('estatus', '=', '5')->count();
    }

    public static function totalUsuarios()
    {
        return User::all()->count();
    }

    public static function totalProcessos()
    {
        //return Requerente::where('status', '=', 5)->count();
        return Processo::all()->count();
    }

    public static function totalProcessosMesAnoCorrente()
    {
        return DB::table('processos')->whereMonth('created_at', date('n'))->count();
    }

    // SEMPRE HAVERÁ UM MÊS E UM ANO DEFINIDO
    public static function totalProcessosMesAnoEspecifico($mes, $ano)
    {
        return DB::table('processos')->whereMonth('created_at', date($mes))->whereYear('created_at', date($ano))->count();
    }

    public static function processos()
    {
        // $processos = Processo::orderBy('nomecompleto')->paginate(10);
        // return Processo::orderBy('nomecompleto')->paginate(10);
        return Processo::orderByDesc('created_at')->paginate(10);
    }


}
