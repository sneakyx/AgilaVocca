<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function native()
    {
        return $this->belongsToMany(Book::class, 'book_chapter_native', 'language_id', 'book_id')->withTimestamps();
    }

    public function foreign()
    {
        return $this->belongsToMany(Book::class, 'book_chapter_foreign', 'language_id', 'book_id')->withTimestamps();
    }

}
