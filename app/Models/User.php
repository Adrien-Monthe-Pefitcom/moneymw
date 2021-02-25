<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'sexe',
        'identifiant_unique',
        'ville',
        'pays',
        'phone',
        'type_compte',
        'profession',
        'date_naissance',
        'nom_banque',
        'num_piece',
        'scan_piece_recto',
        'scan_piece_verso',
        'photo',
        'refere_par',
        'remember_token',
        'num_compte_bancaire',
        'signature',
        'created_by',
        'commercial_id',
        'superviseur_id',
        'no_compte_carte_virtuelle'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }


    public function getJWTCustomClaims() {
        return [];
    }
}
