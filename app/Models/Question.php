<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Choix;
use App\Models\Exercice;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'Question',
        'exercice_id',
    ];

    public function Exercice()
    {
        return $this->belongsTo(Exercice::class);
    }
    public function Choixes()
    {
        return $this->hasMany(Choix::class);
    }
}
