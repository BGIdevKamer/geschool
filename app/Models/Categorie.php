<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matiere;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'libeller',
        'randomUser',
    ];

    public function Matieres()
    {
        return $this->hasMany(Matiere::class);
    }
}
