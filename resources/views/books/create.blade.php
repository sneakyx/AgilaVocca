@extends('layouts')
@section('content')
    <form action="{{ route('book.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="native_language_id">Native Language:</label>
            <select name="native_language_id" id="native_language_id">
                @foreach ($languages as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="foreign_language_id">Foreign Language:</label>
            <select name="foreign_language_id" id="foreign_language_id">
                @foreach ($languages as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
