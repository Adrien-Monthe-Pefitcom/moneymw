<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trans_code',
        'trans_type',
        'trans_mode',
        'sender_id',
        'receiver_id',
        'amount',
        'currency',
        'sender_name',
        'receiver_name',
        'status'
    ];
}
