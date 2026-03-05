<?php

namespace Tests\Feature\Console;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Translation;

class VocabImportCommandTest extends TestCase
{
    use RefreshDatabase;
    
    protected $foreignLanguage;
    protected $nativeLanguage;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Sprachen vor jedem Test neu erstellen
        $this->foreignLanguage = \App\Models\Language::factory()->create([
            'name' => 'English',
            'slug' => 'en'
        ]);
        $this->nativeLanguage = \App\Models\Language::factory()->create([
            'name' => 'German',
            'slug' => 'de'
        ]);
    }
    
    public function test_import_json_to_new_book()
    {
        $filePath = storage_path('test_import.json');
        $data = [
            'metadata' => [
                'version' => '1.0',
                'languages' => [
                    'foreign' => $this->foreignLanguage->slug,
                    'native' => $this->nativeLanguage->slug,
                ],
                'book' => 'Test Book',
                'lesson' => 'Test Lesson',
            ],
            'vocabularies' => [
                [
                    'foreign' => ['hello'],
                    'native' => ['Hallo'],
                ],
            ],
        ];
        file_put_contents($filePath, json_encode($data));
        
        $this->artisan('vocab:import', [
            '--file' => $filePath,
            '--new-book' => true,
            '--format' => 'json',
        ])
        ->assertExitCode(0);
        
        $this->assertDatabaseHas('books', ['title' => 'Test Book']);
        $this->assertDatabaseHas('lessons', ['name' => 'Test Lesson']);
        $this->assertDatabaseCount('vocabularies', 1);
        
        unlink($filePath);
    }
    
    public function test_import_json_newline_to_existing_lesson()
    {
        $book = Book::factory()->create();
        $lesson = Lesson::factory()->create(['book_id' => $book->id]);
        
        $filePath = storage_path('test_import.jsonl');
        $data = <<<JSONL
{"metadata": {"version": "1.0", "languages": {"foreign": "{$this->foreignLanguage->slug}", "native": "{$this->nativeLanguage->slug}"}, "book": "{$book->title}", "lesson": "{$lesson->name}"}}
{"foreign": ["world"], "native": ["Welt"]}
JSONL;
        file_put_contents($filePath, $data);
        
        $this->artisan('vocab:import', [
            '--file' => $filePath,
            '--lesson' => $lesson->id,
            '--format' => 'json-newline',
        ])
        ->assertExitCode(0);
        
        $this->assertDatabaseCount('vocabularies', 1);
        $this->assertDatabaseHas('vocabularies', ['word' => 'world']);
        
        unlink($filePath);
    }
    
    public function test_import_with_dry_run()
    {
        $filePath = storage_path('test_import.json');
        $data = [
            'metadata' => [
                'version' => '1.0',
                'languages' => [
                    'foreign' => $this->foreignLanguage->slug,
                    'native' => $this->nativeLanguage->slug,
                ],
                'book' => 'Test Book',
                'lesson' => 'Test Lesson',
            ],
            'vocabularies' => [
                [
                    'foreign' => ['hello'],
                    'native' => ['Hallo'],
                ],
            ],
        ];
        file_put_contents($filePath, json_encode($data));
        
        $this->artisan('vocab:import', [
            '--file' => $filePath,
            '--new-book' => true,
            '--dry-run' => true,
            '--format' => 'json',
        ])
        ->expectsOutput('Dry run successful. Would import 1 vocabularies.')
        ->assertExitCode(0);
        
        $this->assertDatabaseCount('books', 0);
        $this->assertDatabaseCount('vocabularies', 0);
        
        unlink($filePath);
    }
}