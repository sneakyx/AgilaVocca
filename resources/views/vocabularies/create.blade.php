@extends('layouts')
@section('content')
    <form action="{{ route('vocabulary.store') }}" method="POST">
        @csrf
        <div>
            <label for="foreign">{{$foreignLanguage}}:</label>
            <input type="text" name="foreign" id="foreign">
        </div>
        <div>
            <label for="native">{{$nativeLanguage}}:</label>
            <input type="text" name="native" id="native">
        </div>
        <div>
            <label for="chapter_id">{{__('book.id')}}:</label>
            <select name="chapter_id" id="chapter_id">
                @foreach ($chapters as $chapter)
                    <option value="{{ $chapter->id }}" {{ $selectedChapter == $chapter->id ? 'selected' : '' }}>
                        {{ $chapter->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn-agila-vocca" type="submit">Create</button><br>
        <a href="{{route('vocabulary.index')}}" class="btn-agila-vocca">
            <x-ri-arrow-go-back-line class="h-5 w-5"/>
            <span>{{ __('Cancel') }}</span>
        </a>
    </form>
@endsection
