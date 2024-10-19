<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciceParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'participant_id',
        'exercice_id',
    ];
}
