<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;
use App\Models\Participant;

class FormationParticipantPayement extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'pay_date',
        'participant_id',
        'formation_id',
    ];
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
