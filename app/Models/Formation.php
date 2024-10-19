<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\Tranche;
use App\Models\Cour;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'durée',
        'note',
        'prix',
        'EnLigne',
        'statue',
        'Niveau_requie',
        'randomUser',
    ];
    public function cours()
    {
        return $this->hasMany(Cour::class);
    }
    public function Tranches()
    {
        return $this->hasMany(Tranche::class);
    }
}
