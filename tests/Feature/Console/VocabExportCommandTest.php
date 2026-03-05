<?php

namespace Tests\Feature\Console;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Translation;

class VocabExportCommandTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_export_book_to_json()
    {
        $book = Book::factory()->create();
        $lesson = Lesson::factory()->create(['book_id' => $book->id]);
        $vocab = Vocabulary::factory()->create(['lesson_id' => $lesson->id]);
        Translation::factory()->create(['vocabulary_id' => $vocab->id]);
        
        $filePath = storage_path('test_export.json');
        
        $this->artisan('vocab:export', [
            '--book' => $book->id,
            '--file' => $filePath,
            '--format' => 'json',
        ])
        ->assertExitCode(0);
        
        $this->assertFileExists($filePath);
        $content = json_decode(file_get_contents($filePath), true);
        
        $this->assertArrayHasKey('metadata', $content);
        $this->assertArrayHasKey('vocabularies', $content);
        $this->assertCount(1, $content['vocabularies']);
        
        unlink($filePath);
    }
    
    public function test_export_lesson_to_json_newline()
    {
        $book = Book::factory()->create();
        $lesson = Lesson::factory()->create(['book_id' => $book->id]);
        $vocab = Vocabulary::factory()->create(['lesson_id' => $lesson->id]);
        Translation::factory()->create(['vocabulary_id' => $vocab->id]);
        
        $filePath = storage_path('test_export.jsonl');
        
        $this->artisan('vocab:export', [
            '--lesson' => $lesson->id,
            '--file' => $filePath,
            '--format' => 'json-newline',
        ])
        ->assertExitCode(0);
        
        $this->assertFileExists($filePath);
        $content = file_get_contents($filePath);
        
        $this->assertStringContainsString('"metadata"', $content);
        $this->assertStringContainsString('"foreign"', $content);
        
        unlink($filePath);
    }
}