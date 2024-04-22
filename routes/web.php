<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\VocabularyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard',['headerText'=>'Dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// chapter routes
Route::get('/chapters', [ChapterController::class, 'index'])->name('chapter.index');
Route::get('/chapters/create', [ChapterController::class, 'create'])->name('chapter.create');
Route::get('/chapters/{chapter}', [ChapterController::class, 'show'])->name('chapter.show');
Route::get('/chapters/edit/{chapter}', [ChapterController::class, 'edit'])->name('chapter.edit');
Route::post('/chapters', [ChapterController::class, 'store'])->name('chapter.store');
Route::put('/chapters/{chapter}', [ChapterController::class, 'update'])->name('chapter.update');
Route::delete('/chapters/{chapter}', [ChapterController::class, 'destroy'])->name('chapter.destroy');

// book routes
Route::get('/books', [BookController::class, 'index'])->name('book.index');
Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
Route::get('/books/{book}', [BookController::class, 'show'])->name('book.show');
Route::get('/books/edit/{book}', [BookController::class, 'edit'])->name('book.edit');
Route::post('/books', [BookController::class, 'store'])->name('book.store');
Route::put('/books/{book}', [BookController::class, 'update'])->name('book.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('book.destroy');

// language routes
Route::get('/languages', [LanguageController::class, 'index'])->name('language.index');
Route::get('/languages/create', [LanguageController::class, 'create'])->name('language.create');
Route::get('/languages/{language}', [LanguageController::class, 'show'])->name('language.show');
Route::get('/languages/edit/{language}', [LanguageController::class, 'edit'])->name('language.edit');
Route::post('/languages', [LanguageController::class, 'store'])->name('language.store');
Route::put('/languages/{language}', [LanguageController::class, 'update'])->name('language.update');
Route::delete('/languages/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');

// vocabulary routes
Route::get('/vocabularies', [VocabularyController::class, 'index'])->name('vocabulary.index');
Route::get('/vocabularies/create', [VocabularyController::class, 'create'])->name('vocabulary.create');
Route::get('/vocabularies/{id}', [VocabularyController::class, 'show'])->name('vocabulary.show');
Route::get('/vocabularies/edit/{id}', [VocabularyController::class, 'edit'])->name('vocabulary.edit');
Route::post('/vocabularies', [VocabularyController::class, 'store'])->name('vocabulary.store');
Route::put('/vocabularies/{id}', [VocabularyController::class, 'update'])->name('vocabulary.update');
Route::delete('/vocabularies/{id}', [VocabularyController::class, 'destroy'])->name('vocabulary.destroy');

require __DIR__ . '/auth.php';
