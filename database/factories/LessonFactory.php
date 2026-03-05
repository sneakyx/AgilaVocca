<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lesson;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;
    
    public function definition()
    {
        return [
            'book_id' => \App\Models\Book::factory(),
            'name' => $this->faker->word,
        ];
    }
}