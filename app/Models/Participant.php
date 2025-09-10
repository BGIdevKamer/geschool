<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Formation;
use App\Models\FormationParticipant;
use App\Models\ExerciceParticipant;
use Illuminate\Notifications\Notifiable;

class Participant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'dateN',
        'sexe',
        'age',
        'cni',
        'photo',
        'activite',
        'Pays',
        'NiveauScolaire',
        'password',
        'randomUser',
    ];


    protected $hidden = [
        'password', // Cachez le mot de passe lors de la sérialisation
    ];

    public function FormationParticipants()
    {
        return $this->hasMany(FormationParticipant::class);
    }
    public function ExerciceParticipant()
    {
        return $this->hasMany(ExerciceParticipant::class);
    }
}
