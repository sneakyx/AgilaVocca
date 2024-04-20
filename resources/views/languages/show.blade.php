@extends('layouts')

@section('content')
    <script>
        function confirmDelete(languageId) {
            if (confirm('Are you sure you want to delete this language?')) {
                document.getElementById('delete-form-' + languageId).submit();
            }
        }
    </script>
    {{$language->name}} is used in [TODO] books.<br>
    <a href="{{route('language.edit',['language'=>$language])}}" type="button" class="btn button">{{__('language.edit')}}</a><br>
    <form id="delete-form-{{ $language->id }}" action="{{ route('language.destroy', ['language' => $language]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete({{ $language->id }})">Delete</button>
    </form>
@endsection
