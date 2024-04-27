@extends('layouts')

@section('content')
    {{ __('general.logged-in') }}<br>
    <br>
    <a href="{{route('vocabulary-test.index')}}" class="btn btn-agila-vocca"> {{__('general.start-test')}}</a>
@endsection
