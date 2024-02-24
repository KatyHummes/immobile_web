<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immobile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
    ];

    public function Photos()
    {
        return $this->hasMany(Photo::class);
    }
}
