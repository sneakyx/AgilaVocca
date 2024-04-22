@extends('layouts')
@section('content')
    <form action="{{ route('vocabulary.store') }}" method="POST">
        @csrf
        <div>
            <label for="native">{{__('vocabulary.native')}}:</label>
            <input type="text" name="native" id="native">
        </div>
        <div>
            <label for="foreign">{{__('vocabulary.foreign')}}:</label>
            <input type="text" name="foreign" id="foreign">
        </div>
        <div>
            <label for="chapter_id">{{__('book.id')}}:</label>
            <select name="chapter_id" id="chapter_id">
                @foreach ($chapters as $chapter)
                    <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn-agila-vocca" type="submit">Create</button>
    </form>
@endsection
