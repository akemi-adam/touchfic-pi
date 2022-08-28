<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentchapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'chapter_id',
        'user_id',
    ];

    public function storie()
    {
        return $this->belongsTo(Storie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}