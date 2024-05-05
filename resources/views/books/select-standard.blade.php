@extends('layouts')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($books as $book)
            <div class="mt-4">
                <a href="{{ route('book.select-standard', $book) }}" class="btn-agila-vocca flex items-center space-x-2">
                    <x-ri-eye-line class="h-5 w-5" />
                    <span>{{ $book->title }}</span>
                </a>
            </div>
        @endforeach
    </div>

@endsection
