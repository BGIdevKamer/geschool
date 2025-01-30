<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;

class Emploie extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'randomUser',
        'anneeScolaire',
        'date_debut',
        'date_fin',
        'note',
        'titre',
        'niveau',
    ];
    public function Formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
