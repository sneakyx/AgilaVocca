@extends('layouts')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">{{ __('vocabulary.edit') }}</h1>

        <form action="{{ route('vocabulary.update', $vocabulary) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="native" class="block text-sm font-medium text-gray-700">{{ __('native') }}</label>
                <input type="text" name="native" id="native" value="{{ $vocabulary->native }}"
                       class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="foreign" class="block text-sm font-medium text-gray-700">{{ __('foreign') }}</label>
                <input type="text" name="foreign" id="foreign" value="{{ $vocabulary->foreign }}"
                       class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div>
                <label for="chapter_id">{{__('chapter.id')}}</label>
                <select name="chapter_id" id="chapter_id">
                    {{dump($chapters)}}

                </select>
            </div>

            <!-- Submit-Button -->
            <button type="submit" class="btn-agila-vocca">
                {{ __('vocabulary.update') }}
            </button>
        </form>
    </div>
@endsection
