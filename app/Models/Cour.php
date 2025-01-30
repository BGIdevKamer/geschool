<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;
use App\Models\Piece;
use App\Models\Exercice;
use App\Models\Module;

class Cour extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'libeller',
        'desc',
        'module_id',
        'videoLink',
        'youtubeid',
        'imgLink',
        'Content',
    ];

    public function Module()
    {
        return $this->belongsTo(Module::class);
    }
    public function Pieces()
    {
        return $this->hasMany(Piece::class);
    }
    public function Exercices()
    {
        return $this->hasMany(Exercice::class);
    }
}
