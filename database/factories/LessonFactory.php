<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lesson;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition()
    {
        return [
            'book_id' => Book::factory(),
            'name' => $this->faker->word,
        ];
    }
}
