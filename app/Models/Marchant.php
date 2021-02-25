<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marchant extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom',
        'raison',
        'forme',
        'date_creation',
        'email',
        'contact_gerant',
        'siege',
        'phone',
        'site',
        'activite',
        'gerant_id',
        'commercial_id',
        'superviseur_id'
    ];
}
