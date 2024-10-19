<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = [
        'extension',
        'courId',
        'link',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
