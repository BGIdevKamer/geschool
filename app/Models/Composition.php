<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormationParticipant;
use App\Models\Matiere;
use App\Models\Evaluation;

class Composition extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'appreciate',
        'formation_participant_id',
        'evaluation_id',
    ];
    public function FormationParticipant()
    {
        return $this->belongsTo(FormationParticipant::class);
    }
    public function Matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
    public function Evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
