<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use App\Models\Composition;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'libeller',
        'heures',
        'coefs',
        'randomUser',
    ];
    public function Categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function compositions()
    {
        return $this->hasMany(Composition::class);
    }
}
