<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{

    private $validation = [
        'title' => 'required|string|max:255',
        'book_id' => 'required|exists:books,id',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::paginate(10);
        return view('chapters.index', ['chapters' => $chapters, 'headerText' => __('general.chapters')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::all();
        return view('chapters.create', [
            'books' => $books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->validation);

        $chapter = new Chapter();
        $chapter->title = $request->input('title');
        $chapter->book_id = $request->book_id;
        $chapter->save();

        return redirect()->route('chapter.index')->with('success', __('chapters.created-new-successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        return view('chapters.show', ['chapter' => $chapter]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
    {
        $books = Book::all();
        return view('chapters.edit', ['chapter' => $chapter, 'books' => $books,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        $request->validate($this->validation);

        $chapter->title = $request->title;
        $chapter->book_id = $request->book_id;
        $chapter->save();

        return redirect()->route('chapter.index')->with('success', 'Chapter updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->route('chapter.index')->with('success', 'Chapter deleted successfully');
    }
}
