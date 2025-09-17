<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FormationParticipant;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_participant_id',
        'montant',
        'pay_date',
        'motif',
        'note',
        'url',
    ];

    public function FormationParticipant()
    {
        return $this->belongsTo(FormationParticipant::class);
    }
}
