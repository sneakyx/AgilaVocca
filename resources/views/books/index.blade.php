@extends('layouts')

@section('content')
    <div class="row">
        <div class="col">
            <h5>Title</h5>
        </div>
        <div class="col">
            <h5>Native Language</h5>
        </div>
        <div class="col">
            <h5>Foreign Language</h5>
        </div>
        <div class="col">
            <h5>Actions</h5>
        </div>
    </div>
    @foreach ($books as $book)
        <div class="row">
            <div class="col">{{ $book->title }}</div>
            <div class="col">{{ $book->nativeLanguage->name }}</div>
            <div class="col">{{ $book->foreignLanguage->name }}</div>
            <div class="col">
            </div>
        </div>
    @endforeach
    {{ $books->links() }}
    <a href="{{ route('book.create') }}" class="btn btn-primary">{{ __('books.create-new') }}</a>
@endsection
