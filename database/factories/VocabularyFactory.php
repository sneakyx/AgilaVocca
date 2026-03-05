<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vocabulary;

class VocabularyFactory extends Factory
{
    protected $model = Vocabulary::class;
    
    public function definition()
    {
        return [
            'lesson_id' => \App\Models\Lesson::factory(),
            'word' => $this->faker->word,
            'native' => $this->faker->word,
            'foreign' => $this->faker->word,
            'chapter_id' => function () {
                return \App\Models\Chapter::factory()->create()->id;
            },
        ];
    }
}