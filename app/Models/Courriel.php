<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courriel extends Model
{
    protected $fillable = [
        'participant_id',
        'user_id',
        'Message',
        'sujet',
        'is_View',
    ];

    use HasFactory;
}
