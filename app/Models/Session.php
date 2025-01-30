<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Salle;
use App\Models\Matiere;
use App\Models\Enseigant;
use App\Models\Heure;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'matiere_id',
        'enseigant_id',
        'salle_id',
        'emploie_id',
        'heure_id',
        'jour',
    ];

    public function Salle()
    {
        return $this->belongsTo(Salle::class);
    }
    public function Matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
    public function Enseigant()
    {
        return $this->belongsTo(Enseigant::class);
    }
    public function Heure()
    {
        return $this->belongsTo(Heure::class);
    }
}
