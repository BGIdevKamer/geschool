<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;
use App\Models\Participant;
use App\Models\Payement;

class FormationParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'formation_id',
        'anneeScolaire',
        'niv',
    ];
    public function Participant()
    {
        return $this->belongsTo(Participant::class);
    }
    public function Formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function Payements()
    {
        return $this->hasMany(Payement::class);
    }
}
