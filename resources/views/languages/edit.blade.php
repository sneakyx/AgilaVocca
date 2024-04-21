@extends('layouts')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">{{ __('languages.edit') }}</h1>

        <form action="{{ route('language.update', $language) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Language Name') }}</label>
                <input type="text" name="name" id="name" value="{{ $language->name }}"
                       class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>

            <!-- Submit-Button -->
            <button type="submit" class="btn-agila-vocca">
                {{ __('Update Language') }}
            </button>
        </form>
    </div>
@endsection
