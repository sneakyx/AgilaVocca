@extends('layouts')

@section('content')
    {{$language->name}} is used in [TODO] books.<br>
    <a href="{{route('language.edit',['id'=>$language->id])}}" type="button" class="btn button">{{__('language.edit')}}</a><br>
    <a href="{{route('language.destroy',['id'=>$language->id])}}" type="button" class="btn button">{{__('language.destroy')}}</a>
@endsection
