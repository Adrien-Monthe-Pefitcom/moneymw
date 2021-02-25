<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointVente extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner',
        'rccm',
        'copie_rccm',
        'carte_contribuable',
        'non_redevance',
        'location',
        'initial_deposit',
        'superviseur_id'
    ];
}
