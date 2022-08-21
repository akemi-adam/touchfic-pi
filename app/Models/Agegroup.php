<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agegroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'agegroup',
    ];

    public function stories()
    {
        return $this->hasMany(Storie::class);
    }
}
