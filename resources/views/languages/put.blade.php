@extends('layouts')

@section('content')
    <h1>{{ __('languages.edit') }}</h1>

    <form action="{{ route('language.store') }}" method="POST">
        @csrf

        <label for="name">{{ __('languages.name') }}</label>
        <input type="text" name="name" id="name" required><br>


        <button class="btn btn-primary" type="submit">{{ __('languages.save') }}</button>
    </form>
@endsection
