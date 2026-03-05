<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Translation;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;
    
    public function definition()
    {
        return [
            'vocabulary_id' => \App\Models\Vocabulary::factory(),
            'translation' => $this->faker->word,
        ];
    }
}