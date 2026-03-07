<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Translation;
use Illuminate\Support\Facades\Validator;

class VocabImportService
{
    public function import(
        string $filePath,
        ?int $bookId,
        ?int $lessonId,
        bool $newBook,
        bool $newLesson,
        bool $clearBook,
        bool $clearLesson,
        bool $dryRun,
        string $format
    ): array {
        $data = $this->parseFile($filePath, $format);
        $errors = [];
        $count = 0;

        if ($dryRun) {
            return [
                'count' => count($data['vocabularies']),
                'errors' => [],
            ];
        }

        if ($newBook) {
            $foreignLanguageId = $this->getLanguageId($data['metadata']['languages']['foreign'] ?? 'en');
            $nativeLanguageId = $this->getLanguageId($data['metadata']['languages']['native'] ?? 'de');

            $book = Book::create([
                'title' => $data['metadata']['book'] ?? 'Imported Book',
                'foreign_language_id' => $foreignLanguageId,
                'native_language_id' => $nativeLanguageId,
            ]);
            $bookId = $book->id;

            // Lesson automatisch erstellen
            $lesson = Lesson::create([
                'book_id' => $bookId,
                'name' => $data['metadata']['lesson'] ?? 'Imported Lesson',
            ]);
            $lessonId = $lesson->id;
        }

        if ($newLesson) {
            $lesson = Lesson::create([
                'book_id' => $bookId,
                'name' => $data['metadata']['lesson'] ?? 'Imported Lesson',
            ]);
            $lessonId = $lesson->id;
        }

        if ($clearBook && $bookId) {
            Vocabulary::whereHas('lesson', function ($q) use ($bookId) {
                $q->where('book_id', $bookId);
            })->delete();
        }

        if ($clearLesson && $lessonId) {
            Vocabulary::where('lesson_id', $lessonId)->delete();
        }

        foreach ($data['vocabularies'] as $vocabData) {
            $validator = Validator::make($vocabData, [
                'foreign' => 'required|array|min:1',
                'foreign.*' => 'required|string|max:255',
                'native' => 'required|array|min:1',
                'native.*' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $errors[] = "Invalid vocabulary data: " . json_encode($vocabData);
                continue;
            }

            if ($dryRun) {
                $count++;
                continue;
            }

            // create chapter, if not exists
            $chapter = Chapter::firstOrCreate([
                'book_id' => $bookId ?? ($lessonId ? Lesson::find($lessonId)->book_id : 1),
                'title' => $data['metadata']['lesson'] ?? 'Imported Chapter',
            ]);

            $vocab = Vocabulary::create([
                'lesson_id' => $lessonId,
                'word' => $vocabData['foreign'][0],
                'native' => $vocabData['native'][0],
                'foreign' => $vocabData['foreign'][0],
                'chapter_id' => $chapter->id,
            ]);

            foreach ($vocabData['native'] as $translation) {
                Translation::create([
                    'vocabulary_id' => $vocab->id,
                    'translation' => $translation,
                ]);
            }

            $count++;
        }

        return [
            'count' => $count,
            'errors' => $errors,
        ];
    }

    protected function parseFile(string $filePath, string $format): array
    {
        $content = file_get_contents($filePath);

        if ($format === 'json') {
            return json_decode($content, true);
        } elseif ($format === 'json-newline') {
            $lines = explode("\n", $content);
            $data = [];

            foreach ($lines as $line) {
                if (empty(trim($line))) continue;
                $decoded = json_decode($line, true);

                if (isset($decoded['metadata'])) {
                    $data['metadata'] = $decoded['metadata'];
                } elseif (isset($decoded['foreign'])) {
                    $data['vocabularies'][] = $decoded;
                }
            }

            return $data;
        }

        throw new \InvalidArgumentException('Invalid format.');
    }

    protected function getLanguageId(string $code): int
    {
        $language = Language::where('slug', $code)->first();

        if (!$language) {
            // create language, if not exists
            $language = Language::create([
                'name' => ucfirst($code),
                'slug' => $code,
            ]);
        }

        return $language->id;
    }
}
