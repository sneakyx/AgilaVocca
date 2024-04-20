@extends('layouts')

@section('content')
    <ul>
        @foreach ($languages as $language)
            <li><a href="{{route('language.show',['id'=>$language->id])}}">{{ $language->name }}</a></li>
        @endforeach
    </ul>
    {{ $languages->links() }}
    <a href="{{ route('language.create') }}" class="btn btn-primary">{{ __('languages.create-new') }}</a>
@endsection
