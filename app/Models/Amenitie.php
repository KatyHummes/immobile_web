<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'immobile_id',
        'tv',
        'wifi',
        'air_conditioning',
        'bathroom',
        'moving',
        'furnished',
        'garage',
        'ordinance',
        'reservation',
        'maintenance',
        'payment',
        'couple',
        'smoker',
        'pets',
        'visits'
    ];

    public function immobile()
    {
        return $this->belongsTo(Immobile::class);
    }
}
