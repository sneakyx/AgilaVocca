@extends('layouts')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
            <a href="{{ route('chapter.create') }}" class="btn-agila-vocca">{{ __('chapters.create-new') }}</a>
        </div>
        @foreach ($chapters as $chapter)
            <div>
                <h2 class="text-xl font-bold mb-2">{{ $chapter->title }}</h2>
                <p class="text-sm text-gray-500 mb-2">{{ $chapter->book->title }}</p>
            </div>
            <div class="mt-4">
                <a href="{{ route('chapter.show', $chapter) }}" class="btn-agila-vocca flex items-center space-x-2">
                    <x-ri-eye-line class="h-5 w-5" />
                    <span>{{ __('chapters.show') }}</span>
                </a>
                <a href="{{ route('chapter.edit', $chapter) }}" class="btn-agila-vocca flex items-center space-x-2">
                    <x-ri-pencil-line class="h-5 w-5" />
                    <span>{{ __('chapters.edit') }}</span>
                </a>
            </div>
        @endforeach
    </div>

    {{ $chapters->links() }}
@endsection
