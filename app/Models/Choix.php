<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_correct',
        'content',
        'question_id',
    ];
}
