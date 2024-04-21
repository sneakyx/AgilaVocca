@extends('layouts')
@section('header')
    {{ __('languages.create-new') }}
@endsection

@section('content')

    <form action="{{ route('language.store') }}" method="POST">
        @csrf

        <label for="name">{{ __('languages.name') }}</label>
        <input type="text" name="name" id="name" required><br>

        <button class="btn-agila-vocca" type="submit">
            <x-ri-save-2-line class="inline-block w-4 h-4 mr-1"/>
            {{ __('languages.save') }}
        </button>
        <a href="{{ route('language.index') }}" class="btn-agila-vocca inline-block mb-2">
            <x-ri-arrow-go-back-line class="h-5 w-5 mr-1" />
            <span>{{ __('Cancel') }}</span>
        </a>

    </form>
@endsection
