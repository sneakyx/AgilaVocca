@extends('layouts')
@section('content')
    <form action="{{ route('chapter.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">{{__('chapter.title')}}:</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="book_id">{{__('book.id')}}:</label>
            <select name="book_id" id="book_id">
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn-agila-vocca" type="submit">Create</button>
    </form>
@endsection
