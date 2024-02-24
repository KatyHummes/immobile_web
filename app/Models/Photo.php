<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'photo_path',
    ];

    public function Immobile()
    {
        return $this->belongsTo(Immobile::class);
    }
}
