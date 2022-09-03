<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'nome',
        'email',
        'password',
    ];

     /**
     * Este metodo busca o primary key do usuario e insere no campo 'subject' do JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

     /**
     * Returna um array com atributos personalizados que vão ser inseridos no token.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
