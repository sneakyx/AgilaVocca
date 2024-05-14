<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }
}
