<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immobile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function amenitie()
    {
        return $this->belongsTo(Amenitie::class);
    }
}
