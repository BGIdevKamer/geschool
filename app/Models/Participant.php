<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;
use App\Models\FormationParticipantPayement;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'dateN',
        'sexe',
        'age',
        'cni',
        'NiveauScolaire',
        'randomUser',
    ];
    public function Formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_participant')->whithPivot(['anneeScolaire']);
    }
    public function payements()
    {
        return $this->hasMany(FormationParticipantPayement::class);
    }
}
