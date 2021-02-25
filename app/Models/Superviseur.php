<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superviseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'matricule',
        'cv',
        'last_diploma',
        'motivation_letter',
        'casier_judi',
        'languages',
        'years_experience',
        'start_date',
        'end_date',
        'revenu',
        'user_id'
    ];
}
