@extends('layouts')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">{{ __('chapters.edit') }}</h1>

        <form action="{{ route('chapter.update', $chapter) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Chapter Name') }}</label>
                <input type="text" name="title" id="title" value="{{ $chapter->title }}"
                       class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div>
                <label for="book_id">{{__('book.id')}}</label>
                <select name="book_id" id="book_id">
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" {{ $book->id == $chapter->book->id ? 'selected' : '' }}>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit-Button -->
            <button type="submit" class="btn-agila-vocca">
                {{ __('chapter.update') }}
            </button>
        </form>
    </div>
@endsection
