<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

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
}
