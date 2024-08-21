<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'libeller',
        'prix',
        'periode',
        'actif',
        'avantages',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
