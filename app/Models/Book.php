<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
    public function nativeLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'native_language_id');
    }

    public function foreignLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'foreign_language_id');
    }

    public function defaultForUsers(): HasMany
    {
        return $this->hasMany('App\Models\User', 'default_book_id');
    }
}
