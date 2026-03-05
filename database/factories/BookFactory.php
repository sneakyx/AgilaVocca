<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

class BookFactory extends Factory
{
    protected $model = Book::class;
    
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'foreign_language_id' => \App\Models\Language::factory(),
            'native_language_id' => \App\Models\Language::factory(),
        ];
    }
}