<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Chapter;

class ChapterFactory extends Factory
{
    protected $model = Chapter::class;
    
    public function definition()
    {
        return [
            'book_id' => \App\Models\Book::factory(),
            'title' => $this->faker->word,
        ];
    }
}