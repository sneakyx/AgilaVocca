<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\VocabImportService;
use App\Models\Book;
use App\Models\Lesson;

class VocabImportCommand extends Command
{
    protected $signature = 'vocab:import
        {--file= : Path to the input file}
        {--book= : ID of the existing book to import into}
        {--lesson= : ID of the existing lesson to import into}
        {--new-book : Create a new book}
        {--new-lesson : Create a new lesson}
        {--clear-book : Clear the book before importing}
        {--clear-lesson : Clear the lesson before importing}
        {--dry-run : Simulate the import without making changes}
        {--format=json : Input format (json or json-newline)}';

    protected $description = 'Import vocabularies from JSON or JSON-Newline format';

    public function handle(VocabImportService $importService)
    {
        $filePath = $this->option('file');
        $bookId = $this->option('book');
        $lessonId = $this->option('lesson');
        $newBook = $this->option('new-book');
        $newLesson = $this->option('new-lesson');
        $clearBook = $this->option('clear-book');
        $clearLesson = $this->option('clear-lesson');
        $dryRun = $this->option('dry-run');
        $format = $this->option('format');

        if (!$filePath) {
            $this->error('The --file option is required.');
            return 1;
        }

        if (!file_exists($filePath)) {
            $this->error("File {$filePath} does not exist.");
            return 1;
        }

        if (!in_array($format, ['json', 'json-newline'])) {
            $this->error('Invalid format. Use json or json-newline.');
            return 1;
        }

        if (($bookId || $lessonId) && ($newBook || $newLesson)) {
            $this->error('Cannot use --book/--lesson with --new-book/--new-lesson.');
            return 1;
        }

        if ($bookId && $lessonId) {
            $this->error('Only one of --book or --lesson can be specified.');
            return 1;
        }

        try {
            $result = $importService->import(
                $filePath,
                $bookId,
                $lessonId,
                $newBook,
                $newLesson,
                $clearBook,
                $clearLesson,
                $dryRun,
                $format
            );
            
            if ($dryRun) {
                $this->info("Dry run successful. Would import {$result['count']} vocabularies.");
            } else {
                $this->info("Successfully imported {$result['count']} vocabularies.");
            }
            
            if (!empty($result['errors'])) {
                $this->warn('Errors encountered:');
                foreach ($result['errors'] as $error) {
                    $this->line("- {$error}");
                }
            }
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage() . '\nStack Trace: ' . $e->getTraceAsString());
            return 1;
        }
    }
}