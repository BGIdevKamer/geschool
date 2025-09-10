<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;

class Courriel extends Model
{
    protected $fillable = [
        'participant_id',
        'user_id',
        'Message',
        'sujet',
        'is_View',
    ];

    public function Participant()
    {
        return $this->belongsTo(Participant::class);
    }

    use HasFactory;
}
