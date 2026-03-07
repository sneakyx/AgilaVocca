<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'word',
        'native',
        'foreign',
        'chapter_id'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
