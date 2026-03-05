<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    
    protected $fillable = ['book_id', 'name'];
    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }
}