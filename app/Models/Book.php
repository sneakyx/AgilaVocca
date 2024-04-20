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
    public function nativeLanguage()
    {
        return $this->belongsTo(Language::class, 'native_language_id');
    }

    public function foreignLanguage()
    {
        return $this->belongsTo(Language::class, 'foreign_language_id');
    }

}
