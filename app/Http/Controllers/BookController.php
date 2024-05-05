<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    private $validation = [
        'title' => 'required|string|max:255',
        'native_language_id' => 'required|exists:languages,id',
        'foreign_language_id' => 'required|exists:languages,id',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('books.index', ['books' => $books, 'headerText' => __('general.books')]);
    }

    public function selectStandardBook(?Book $book=null)
    {
        $books = Book::all();
        if ($books->count() === 1) {
            $book = $books[0];
        }
        if (empty($book)) {
            return view('books.select-standard', [
                'books' => $books,
                'headerText' => 'Bitte das Buch wählen',
            ]);
        } else {
            $user=Auth::user();
            $user->standard_book_id = $book->id;
            $user->save();
            $route=session()->get('redirect_after_book_selection') ?? 'dashboard';
            return redirect()->route($route);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages=Language::all();
        return view('books.create', [
            'languages'=>$languages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->validation);

        $book = new Book();
        $book->title = $request->input('title');
        $book->native_language_id = $request->native_language_id;
        $book->foreign_language_id = $request->foreign_language_id;
        $book->save();

        return redirect()->route('book.index')->with('success', __('books.created-new-successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $languages=Language::all();
        return view('books.edit', ['book' => $book,'languages'=>$languages,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate($this->validation);

        $book->title = $request->title;
        $book->native_language_id = $request->native_language_id;
        $book->foreign_language_id = $request->foreign_language_id;
        $book->save();

        return redirect()->route('book.index')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Book deleted successfully');
    }
}
