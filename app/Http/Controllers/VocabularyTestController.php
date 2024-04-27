<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Vocabulary;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\Request;

class VocabularyTestController extends Controller
{
    /*
     * session variables and their usage:
     * - vocabularies: array of ids, which vocabularies have to be tested
     * - meta: associative array, containing following fields:
     *      'correct' => amount of correct answers
     *      'incorrect' => amount of wrong answers
     *      'total' => total amount of vocabularies in selected chapters
     *      'foreign_language' foreign language of book
            'native_language' native language of book
     *     TODO:  'time' => time when test started
     */

    /**
     * Display a listing of the resource.
     */
    public function index(?Book $book = null)
    {
        //make choosing books easier
        $books = Book::all();
        if ($books->count() === 1) {
            $book = $books[0];
        }
        if (empty($book)) {
            return view('vocabularyTest.select-book', [
                'books'=>$books,
                'headerText'=>'Bitte das Buch wählen',
            ]);
        } else {
            $chapters = Chapter::where('book_id', $book->id)
                ->withCount('vocabularies')
                ->get();
            return view('vocabularyTest.select-chapter', [
                'chapters'=>$chapters,
                'headerText'=>'Bitte die Kapitel wählen',
            ]);
        }
    }

    public function prepare(Request $request)
    {
        $chapterIds = $request->get('chapters');
        if (empty($chapterIds)) {
            return redirect()->route('vocabulary-test.index')->with('message', __('vocabularies-test.choose-not-filled'));
        }
        $chapters = Chapter::whereIn('id', $chapterIds)->get();
        $vocabularyIds = [];
        foreach ($chapters as $chapter) {
            $vocabularyIds = array_merge($chapter->vocabularies()->pluck('id')->toArray(), $vocabularyIds);
        }
        $book = $chapters[0]->book;
        session()->put('vocabulary_ids', $vocabularyIds);
        session()->put('meta', [
            'correct' => 0,
            'incorrect' => 0,
            'total' => count($vocabularyIds),
            'test_foreign' => true,   // should foreign word be checked?
            'foreign_language' => $book->foreignLanguage->name,
            'native_language' => $book->nativeLanguage->name,
        ]);

        return redirect()->route('vocabulary-test.form');
    }

    public function form()
    {
        // get infos stored in session for test
        $vocabularyIdsSession = session()->get('vocabulary_ids');
        $sessionMetaInfos = session()->get('meta');

        // test finished?
        if (count($vocabularyIdsSession)===0){
            return redirect()->route('vocabulary-test.result');
        }

        // select random vocabulary
        $randomId = $vocabularyIdsSession[array_rand($vocabularyIdsSession)];
        $vocabulary = Vocabulary::find($randomId);

        if ($vocabulary === null) {
            throw new EntityNotFoundException("There is no vocabulary with id $randomId not found.", $randomId);
        }

        return view('vocabularyTest.show-test-form', compact('vocabularyIdsSession', 'sessionMetaInfos'), [
            'headerText' => __('vocabularies-test.test-loop'),
            'vocabulary' => $vocabulary,
            'metaInfos' => $sessionMetaInfos,
        ]);
    }

    public function check(Request $request)
    {
        // get input from user request
        $phraseFromUser = trim($request->get('vocabulary'));
        $id = $request->get('id');

        // get infos stored in session
        $vocabularyIdsSession = session()->get('vocabulary_ids');
        $sessionMetaInfos = session()->get('meta');
        $vocabularyFromDatabase = Vocabulary::find($id);
        if ($vocabularyFromDatabase === null) {
            throw new EntityNotFoundException("Vocabulary with id $id not found", $id);
        }
        if ($sessionMetaInfos['test_foreign'] === true) {
            $phraseInRightLanguageFromDatabase = $vocabularyFromDatabase->foreign;
        } else {
            $phraseInRightLanguageFromDatabase = $vocabularyFromDatabase->native;
        }

        // check if phrase from user is correct
        if ($phraseInRightLanguageFromDatabase === $phraseFromUser) {
            // vocabulary is correct answered
            $vocabularyIdsSession = array_values(array_filter($vocabularyIdsSession, fn($vocabularyId) => $vocabularyId != $id));
            $sessionMetaInfos['correct']++;
            $howGoodWasAnswer = 'correct';
        } else {
            $sessionMetaInfos['incorrect']++;
            $distance = levenshtein($phraseFromUser, $phraseInRightLanguageFromDatabase);
            if ($distance <= 2) {
                $howGoodWasAnswer = 'nearby';
            } else {
                $howGoodWasAnswer = 'incorrect';
            }
        }
        session()->put('vocabulary_ids', $vocabularyIdsSession);
        session()->put('meta', $sessionMetaInfos);

        return view('vocabularyTest.show-answer', [
            'headerText' => __('vocabularies-test.test-loop'),
            'howGoodWasAnswer' => $howGoodWasAnswer,
            'vocabulary' => $vocabularyFromDatabase,
            'phraseFromUser' => $phraseFromUser,
            'metaInfos' => $sessionMetaInfos,
        ]);
    }

    public function result()
    {

        $metaInfos = session()->get('meta');
        return view('vocabularyTest.finished', [
            'headerText' => __('Test beendet'),
            'percentage' => 100 - ( $metaInfos['incorrect']/ $metaInfos['total']) * 100,
            'metaInfos' => $metaInfos,
        ]);
    }
}
