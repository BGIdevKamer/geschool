<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercice;

class ExerciceParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'participant_id',
        'exercice_id',
    ];
    public function Exercice()
    {
        return $this->belongsTo(Exercice::class);
    }
    public function Participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
