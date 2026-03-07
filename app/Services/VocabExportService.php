<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Lesson;
use App\Models\Vocabulary;

class VocabExportService
{
    public function export(?int $bookId, ?int $lessonId, string $format): string
    {
        $query = Vocabulary::query();
        
        if ($bookId) {
            $book = Book::findOrFail($bookId);
            $query->whereHas('lesson', function ($q) use ($book) {
                $q->where('book_id', $book->id);
            });
        }
        
        if ($lessonId) {
            $lesson = Lesson::findOrFail($lessonId);
            $query->where('lesson_id', $lesson->id);
        }
        
        $vocabularies = $query->with(['lesson.book', 'translations'])->get();
        
        if ($format === 'json') {
            return $this->exportJson($vocabularies);
        } elseif ($format === 'json-newline') {
            return $this->exportJsonNewline($vocabularies);
        }
        
        throw new \InvalidArgumentException('Invalid format.');
    }
    
    protected function exportJson($vocabularies): string
    {
        $data = [
            'metadata' => [
                'version' => '1.0',
                'languages' => [
                    'foreign' => $vocabularies->first()->lesson->book->foreign_language->code ?? 'en',
                    'native' => $vocabularies->first()->lesson->book->native_language->code ?? 'de',
                ],
                'book' => $vocabularies->first()->lesson->book->name ?? null,
                'lesson' => $vocabularies->first()->lesson->name ?? null,
            ],
            'vocabularies' => $vocabularies->map(function ($vocab) {
                return [
                    'foreign' => [$vocab->word],
                    'native' => $vocab->translations->pluck('translation')->toArray(),
                ];
            }),
        ];
        
        return json_encode($data, JSON_PRETTY_PRINT);
    }
    
    protected function exportJsonNewline($vocabularies): string
    {
        $metadata = [
            'metadata' => [
                'version' => '1.0',
                'languages' => [
                    'foreign' => $vocabularies->first()->lesson->book->foreign_language->code ?? 'en',
                    'native' => $vocabularies->first()->lesson->book->native_language->code ?? 'de',
                ],
                'book' => $vocabularies->first()->lesson->book->name ?? null,
                'lesson' => $vocabularies->first()->lesson->name ?? null,
            ],
        ];
        
        $output = json_encode($metadata, JSON_PRETTY_PRINT) . "\n";
        
        foreach ($vocabularies as $vocab) {
            $output .= json_encode([
                'foreign' => [$vocab->word],
                'native' => $vocab->translations->pluck('translation')->toArray(),
            ], JSON_PRETTY_PRINT) . "\n";
        }
        
        return $output;
    }
}