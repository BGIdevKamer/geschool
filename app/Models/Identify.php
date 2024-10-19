<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identify extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'raisonSocial',
        'logo',
        'ville',
        'adress',
        'Bp',
        'type',
        'logo',
        'telephone',
        'randomUser',
    ];
}
