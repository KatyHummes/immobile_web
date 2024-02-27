<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'immobile_id',
        'photo_path',
        'user_id'
    ];

    public function immobile()
    {
        return $this->belongsTo(Immobile::class);
    }
}
