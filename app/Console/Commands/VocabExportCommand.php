<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\VocabExportService;
use App\Models\Book;
use App\Models\Lesson;

class VocabExportCommand extends Command
{
    protected $signature = 'vocab:export
        {--book= : ID of the book to export}
        {--lesson= : ID of the lesson to export}
        {--file= : Path to the output file (default: stdout)}
        {--format=json : Output format (json or json-newline)}';

    protected $description = 'Export vocabularies to JSON or JSON-Newline format';

    public function handle(VocabExportService $exportService)
    {
        $bookId = $this->option('book');
        $lessonId = $this->option('lesson');
        $filePath = $this->option('file');
        $format = $this->option('format');

        if (!$bookId && !$lessonId) {
            $this->error('Either --book or --lesson must be specified.');
            return 1;
        }

        if ($bookId && $lessonId) {
            $this->error('Only one of --book or --lesson can be specified.');
            return 1;
        }

        if (!in_array($format, ['json', 'json-newline'])) {
            $this->error('Invalid format. Use json or json-newline.');
            return 1;
        }

        try {
            $data = $exportService->export($bookId, $lessonId, $format);
            
            if ($filePath) {
                file_put_contents($filePath, $data);
                $this->info("Vocabularies exported to {$filePath}");
            } else {
                $this->line($data);
            }
            
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }
}