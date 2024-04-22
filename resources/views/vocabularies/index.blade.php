@extends('layouts')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
            <a href="{{ route('vocabulary.create') }}" class="btn-agila-vocca">{{ __('vocabularies.create-new') }}</a>
        </div>
        @foreach ($vocabularies as $vocabulary)
            <div>
                <h2 class="text-xl font-bold mb-2">{{ $vocabulary->native }}</h2>
                <p class="text-sm text-gray-500 mb-2">{{ $vocabulary->foreign }}</p>
            </div>
            <div class="mt-4">
                <a href="{{ route('vocabulary.show', $vocabulary) }}" class="btn-agila-vocca flex items-center space-x-2">
                    <x-ri-eye-line class="h-5 w-5" />
                    <span>{{ __('vocabularies.show') }}</span>
                </a>
                <a href="{{ route('vocabulary.edit', $vocabulary) }}" class="btn-agila-vocca flex items-center space-x-2">
                    <x-ri-pencil-line class="h-5 w-5" />
                    <span>{{ __('vocabularies.edit') }}</span>
                </a>
            </div>
        @endforeach
    </div>

    {{ $vocabularies->links() }}
@endsection
