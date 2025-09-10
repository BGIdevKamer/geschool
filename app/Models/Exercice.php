<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Module;
use App\Models\Formation;
use App\Models\ExerciceParticipant;
use App\Models\Cour;

class Exercice extends Model
{
    use HasFactory;

    protected $fillable = [
        'libeller',
        'description',
        'duree',
        'cour_id',
    ];

    public function Questions()
    {
        return $this->hasMany(Question::class);
    }
    public function Module()
    {
        return $this->belongsTo(Module::class);
    }
    public function Formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function Cour()
    {
        return $this->belongsTo(Cour::class);
    }
    public function ExerciceParticipant()
    {
        return $this->hasMany(ExerciceParticipant::class);
    }
}
