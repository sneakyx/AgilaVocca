<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vocabulary;

class VocabularyFactory extends Factory
{
    protected $model = Vocabulary::class;

    public function definition()
    {
        return [
            'lesson_id' => Lesson::factory(),
            'word' => $this->faker->word,
            'native' => $this->faker->word,
            'foreign' => $this->faker->word,
            'chapter_id' => function () {
                return Chapter::factory()->create()->id;
            },
        ];
    }
}
