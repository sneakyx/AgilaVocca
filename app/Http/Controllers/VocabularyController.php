<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class VocabularyController extends Controller
{
    private $validation = [
        'foreign' => 'required|string|max:255',
        'native' => 'required|string|max:255',
        'chapter_id' => 'required|exists:chapters,id',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $book=$user->standardBook;
        session()->put('redirect_after_book_selection', Route::currentRouteName());
        if (empty($book)) {
            return redirect()->route('book.select-standard');
        }
        $chapterIds= Chapter::where('book_id', $book->id)->pluck('id')->toArray();
        $vocabularies = Vocabulary::whereIn('chapter_id', $chapterIds)->paginate(10);
        return view('vocabularies.index', ['vocabularies' => $vocabularies, 'headerText' => __('general.chapters')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($chapterId = null)
    {
        $chapters = Chapter::all();
        if ($chapterId !== null) {
            $chapter = Chapter::find($chapterId);
            $foreignLanguage = $chapter->book->foreignLanguage->name;

            $nativeLanguage = $chapter->book->nativeLanguage->name;
        }
        return view('vocabularies.create', [
            'chapters' => $chapters,
            'selectedChapter' => $chapterId,
            'foreignLanguage' => $foreignLanguage ?? __('vocabulary.foreign'),
            'nativeLanguage' => $nativeLanguage ?? __('vocabulary.native'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->validation);

        $vocabulary = new Vocabulary();
        $vocabulary->native = $request->input('native');
        $vocabulary->foreign = $request->input('foreign');
        $vocabulary->chapter_id = $request->chapter_id;
        $vocabulary->save();

        return redirect()->route('vocabulary.create', ['chapterId' => $vocabulary->chapter_id])->with('success', __('vocabulary.created-new-successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vocabulary $vocabulary)
    {
        return view('vocabularies.show', ['vocabulary' => $vocabulary]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vocabulary $vocabulary)
    {
        $chapters = Chapter::all();
        return view('vocabularies.edit', ['vocabulary' => $vocabulary, 'chapters' => $chapters,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vocabulary $vocabulary)
    {
        $request->validate($this->validation);

        $vocabulary->native = $request->native;
        $vocabulary->foreign = $request->foreign;
        $vocabulary->chapter_id = $request->chapter_id;
        $vocabulary->save();

        return redirect()->route('vocabulary.index')->with('success', 'Vocabulary updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vocabulary $vocabulary)
    {
        $vocabulary->delete();
        return redirect()->route('vocabulary.index')->with('success', 'Vocabulary deleted successfully');
    }
}
