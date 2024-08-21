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
    ];
    public function Formations()
    {
        return $this->belongsToMany(Formation::class,'formation_participant')->whithPivot(['date_debut','date_fin']);
    }
    public function FormationParticipantPayement()
    {
        return $this->hasMany(FormationParticipantPayement::class);
    }
}
