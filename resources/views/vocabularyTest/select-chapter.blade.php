@extends('layouts')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <form action="{{ route('vocabulary-test.prepare') }}" method="POST">
            @csrf
            <label for="chapters">{{__('vocabularies-test.choose-chapter')}}</label>
            <select name="chapters[]" id="chapters" multiple>
                @foreach($chapters as $chapter)
                    <option value="{{ $chapter->id }}">{{ $chapter->title }} ({{$chapter->vocabularies_count}})</option>
                @endforeach
            </select>
            <button class="btn-agila-vocca" type="submit">Auswahl bestätigen</button>
        </form>

    </div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
        {{__('books.chapters',['name'=>$book->title])}}

        <a href="{{ route('book.select-standard') }}" class="btn-agila-vocca">{{ __('books.change') }}</a>
    </div>
@endsection
