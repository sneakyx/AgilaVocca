@extends('layouts')

@section('content')
    {{$language->name}} is used in [TODO] books.<br>
    <a href="{{route('language.edit',['language'=>$language])}}" type="button" class="btn button">{{__('language.edit')}}</a><br>
    <a href="{{route('language.destroy',['language'=>$language])}}" type="button" class="btn button">{{__('language.destroy')}}</a>
@endsection
