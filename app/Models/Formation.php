<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\Module;
use App\Models\Tranche;
use App\Models\FormationParticipant;
use App\Models\Exercice;

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
    public function Tranches()
    {
        return $this->hasMany(Tranche::class);
    }
    public function Modules()
    {
        return $this->hasMany(Module::class);
    }
    public function FormationParticipants()
    {
        return $this->hasMany(FormationParticipant::class);
    }
    public function Exercices()
    {
        return $this->hasMany(Exercice::class);
    }
}
