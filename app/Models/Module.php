<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cour;
use App\Models\Formation;
use App\Models\Exercice;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'libeller',
        'description',
    ];

    public function cours()
    {
        return $this->hasMany(Cour::class);
    }
    public function Formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function Exercices()
    {
        return $this->hasMany(Exercice::class);
    }
}
