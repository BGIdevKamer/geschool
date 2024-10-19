<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;
use App\Models\Pieces;
use App\Models\Exercice;

class Cour extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'libeller',
        'desc',
        'formation_id',
        'videoLink',
        'youtubeid',
        'imgLink',
        'Content',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
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
