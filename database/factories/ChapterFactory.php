<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Chapter;

class ChapterFactory extends Factory
{
    protected $model = Chapter::class;

    public function definition()
    {
        return [
            'book_id' => Book::factory(),
            'title' => $this->faker->word,
        ];
    }
}
