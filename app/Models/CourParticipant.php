<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\Cour;

class CourParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'cour_id',
    ];

    public function Participant()
    {
        return $this->belongsTo(Participant::class);
    }
    public function Cour()
    {
        return $this->belongsTo(Cour::class);
    }
}
