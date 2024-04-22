@extends('layouts')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">{{ __('books.edit') }}</h1>

        <form action="{{ route('book.update', $book) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Book Name') }}</label>
                <input type="text" name="name" id="name" value="{{ $book->title }}"
                       class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div>
                <label for="native_language_id">Native Language:</label>
                <select name="native_language_id" id="native_language_id">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ $language->id == $book->nativeLanguage->id ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="foreign_language_id">Foreign Language:</label>
                <select name="foreign_language_id" id="foreign_language_id">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ $language->id == $book->foreignLanguage->id ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit-Button -->
            <button type="submit" class="btn-agila-vocca">
                {{ __('Update Book') }}
            </button>
        </form>
    </div>
@endsection
