@extends('layouts')

@section('content')
    <h1>{{ __('languages.edit') }}</h1>

    <form action="{{ route('language.update', $language) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Language Name</label>
        <input type="text" name="name" id="name" value="{{ $language->name }}" required>

        <!-- Submit-Button -->
        <button type="submit">Update Language</button>
    </form>
@endsection
