<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heure extends Model
{
    use HasFactory;

    protected $fillable = [
        'heure_debut',
        'min_debut',
        'heure_fin',
        'min_fin',
        'randomUser',
    ];
}
