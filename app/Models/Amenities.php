<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;

    protected $fillable = [
        'immobile_id',
        'rules',
        'Amenities',
        'rules'
    ];

    public function immobile()
    {
        return $this->belongsTo(Immobile::class);
    }

    
}
