<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'numberofwords',
        'authornotes',
        'storie_id',
        'spotify_track',
    ];
    
    public function storie()
    {
        return $this->belongsTo(Storie::class);
    }

    public function comments()
    {
        return $this->hasMany(Commentchapter::class);
    }

}
