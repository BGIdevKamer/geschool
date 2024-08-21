<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\FormationParticipantPayement;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'durée',
        'note',
        'prix',
        'EnLigne',
        'statue',
        'Niveau_requie',
        'randomUser',
    ];
    public function Participants()
    {
        return $this->belongsToMany(Participant::class,'formation_participant')->whithPivot(['date_debut','date_fin']);
    }
    public function FormationParticipantPayement()
    {
        return $this->hasMany(FormationParticipantPayement::class);
    }
}
