@extends('layouts')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
            <a href="{{ route('book.create') }}" class="btn-agila-vocca">{{ __('books.create-new') }}</a>
        </div>
        @foreach ($books as $book)
                <div>
                    <h2 class="text-xl font-bold mb-2">{{ $book->title }}</h2>
                    <p class="text-sm text-gray-500 mb-2">{{ $book->nativeLanguage->name }}</p>
                    <p class="text-sm text-gray-500 mb-2">{{ $book->foreignLanguage->name }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('book.show', $book) }}" class="btn-agila-vocca flex items-center space-x-2">
                        <x-ri-eye-line class="h-5 w-5" />
                        <span>{{ __('books.show') }}</span>
                    </a>
                    <a href="{{ route('book.edit', $book) }}" class="btn-agila-vocca flex items-center space-x-2">
                        <x-ri-pencil-line class="h-5 w-5" />
                        <span>{{ __('books.edit') }}</span>
                    </a>
            </div>
        @endforeach
    </div>

    {{ $books->links() }}
@endsection
