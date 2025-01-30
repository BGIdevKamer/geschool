<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\Formation;
use App\Models\Evaluation;

class Bulletin extends Model
{
    use HasFactory;

    public function Participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function Formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function Evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
