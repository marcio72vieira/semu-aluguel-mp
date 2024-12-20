<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Requerente extends Model
{
    use HasFactory;

    protected $table = "requerentes";

    protected $fillable = [
        'nomecompleto',
        'sexobiologico',
        'nascimento',
        'naturalidade',
        'nacionalidade',
        'rg',
        'orgaoexpedidor',
        'cpf',
        'banco',
        'agencia',
        'conta',
        'contaespecifica',
        'comunidade',
        'outracomunidade',
        'racacor',
        'outraracacor',
        'identidadegenero',
        'outraidentidadegenero',
        'orientacaosexual',
        'outraorientacaosexual',
        'deficiente',
        'deficiencia',
        'escolaridade',
        'profissao',
        'estadocivil',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'foneresidencial',
        'fonecelular',
        'email',
        'regional_id',
        'municipio_id',
        'tipounidade_id',
        'unidadeatendimento_id',
        'user_id',
        'estatus'   // Situação do requerimento: 1 - Andamento 2 - Análise 3 - Pendente 4 - Corrigido 5 - Concluído
    ];


    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }


    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }


    public function tipounidade()
    {
        return $this->belongsTo(Tipounidade::class);
    }


    public function unidadeatendimento()
    {
        return $this->belongsTo(Unidadeatendimento::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalhe()
    {
        return $this->hasOne(Detalherequerente::class);
    }

    public function locacao()
    {
        return $this->hasOne(Locacao::class);
    }

    public function anexos()
    {
        return $this->hasMany(Anexo::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    // Retorna a quantidade de Documentos que o Requetente possui cadastrado
    public static function docsAnexados($id)
    {
        $qtd = DB::table('documentos')->where('requerente_id', '=', $id)->count();
        return $qtd;
    }

    // Este método retorna só o nome do servidor (user), para servir a view (resources/views/admin/checklists/index.blade.php)
    public function servidorResponsavelPelaAnaliseDocumentos($id)
    {
        $servidorResponsavel = DB::table('users')->where('id', '=', $id)->select('nomecompleto')->get();

        //dd($servidorResponsavel);
        return $servidorResponsavel; 
    }

    public static function totalprocessos()
    {
        return $totprocessos = Requerente::where('status', '=', '5')->count();
    } 


    /*
    // Preparado caso as regras mudem e um requerente possa ter mais de um requerimento
    public function requerimentos()
    {
        return $this->hasMany(Requerimento::class);
    }
    public function locacoes()
    {
        return $this->hasMany(Locacao::class);
    }
    */

}
