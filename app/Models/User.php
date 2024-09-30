<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'unidadeatendimento_id',
        'cargo',
        'perfil',
        'email',
        'password',
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

    public function unidadeatendimento()
    {
        return $this->belongsTo(Unidadeatendimento::class);
    }


}
