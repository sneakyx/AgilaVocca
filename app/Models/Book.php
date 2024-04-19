<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class)->withTimestamps();
    }
}
