<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use HasFactory;

    protected $fillable = ['foreign', 'native'];

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class)->withTimestamps();
    }
}
