<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;

    protected $fillable = [
        'immobile_id',
        'tv',
        'wifi',
        'airConditioning',
        'bathroom',
        'moving',
        'furnished',
        'garage',
        'ordinance',
        'reservation',
        'maintenance',
        'payment',
        'couple',
        'Pets',
        'Visits'
    ];

    public function immobile()
    {
        return $this->belongsTo(Immobile::class);
    }
}
