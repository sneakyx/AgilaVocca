@extends('layouts')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ __('languages.index') }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 grid grid-cols-auto">
            <div class="col-span-2">
                <a href="{{ route('language.create') }}" class="btn-agila-vocca mt-4">{{ __('languages.create-new') }}</a>
            </div>
        </div>
        @foreach ($languages as $language)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 grid grid-cols-auto">
                <div class="col-span-2">
                    <h2 class="text-xl font-bold mb-2">{{ $language->name }}</h2>
                </div>
                <div class="col-span-1 flex justify-end items-center space-x-4">
                    <a href="{{ route('language.show', $language) }}" class="btn-agila-vocca flex items-center space-x-2 h-full">
                        <x-ri-eye-line class="h-5 w-5"/>
                        <span>{{ __('languages.show') }}</span>
                    </a>
                    <a href="{{ route('language.edit', $language) }}" class="btn-agila-vocca flex items-center space-x-2 h-full">
                        <x-ri-pencil-line class="h-5 w-5"/>
                        <span>{{ __('languages.edit') }}</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{ $languages->links() }}

@endsection
