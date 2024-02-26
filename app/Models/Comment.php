<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'immobile_id', 
        'comment', 
        'rating'
    ];

    public function immobile()
    {
        return $this->belongsTo(Immobile::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
