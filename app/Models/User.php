<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomecompleto',
        'nome',
        'cpf',
        'regional_id',
        'municipio_id',
        'tipounidade_id',
        'unidadeatendimento_id',
        'cargo',
        'fone',
        'perfil',
        'email',
        'password',
        'ativo',
        'primeiroacesso'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


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

    public function requerentes()
    {
        return $this->hasMany(Requerente::class);
    }

    // Documentos avaliados pelo Servidor da SEMU
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    
    
    public function qtd_requerentes_cadastrados_ou_analisados($idUsuario, $perfilUsuario)
    {
        if($perfilUsuario == "adm" || $perfilUsuario == "srv"){
            $qtd = DB::table('documentos')->distinct('requerente_id')->where('user_id', '=', $idUsuario)->count();
        }
        
        if($perfilUsuario == "ass"){
            $qtd = DB::table('requerentes')->where('user_id', '=', $idUsuario)->count();
        }
        
        return $qtd;
        
    }
    
    /* 
    //Obtendo a quantidade de requerimentos cadastrado pelo usuário com perfil de ASSISTENTE SOCIAL
    public function qtdrequerentescadastrados($id)
    {
        $qtd = DB::table('requerentes')->where('user_id', '=', $id)->count();
        return $qtd;
    }
    //Obtendo a quantidade de requerimentos Analisados processados pelo usuário com perfil de ADMINISTRADOR ou SERVIDOR DA SEMU
    public function qtdrequerentesprocessados($id)
    {
        $qtd = DB::table('documentos')->distinct('requerente_id')->where('user_id', '=', $id)->count();
        return $qtd;
    }
    */
    
}
