<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\plant;

class PlantUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plant_id',
        'date_debut',
        'date_fin',
        'statue',
    ];
     public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Participant()
    {
        return $this->belongsTo(User::class);
    }
}
