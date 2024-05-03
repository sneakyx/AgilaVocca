@extends('layouts')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <form action="{{ route('vocabulary-test.check') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$vocabulary->id}}">
            <div>
                Bisher richtig: {{$metaInfos['correct']}} von {{$metaInfos['total']}}. Fehler: {{$metaInfos['incorrect']}} - Vokabel Nummer: {{$vocabulary->id}}
            </div>
            <div>
                @if ($metaInfos['test_foreign'])
                {{$metaInfos['native_language']}}: {{$vocabulary->native}}
                @else
                    {{$metaInfos['foreign_language']}}: {{$vocabulary->foreign}}
                @endif
            </div>
            <div>
                <label for="foreign">
                    @if ($metaInfos['test_foreign'])
                        {{$metaInfos['foreign_language']}}
                    @else
                        {{$metaInfos['native_language']}}
                    @endif
                    :</label>
                <input type="text" name="vocabulary" id="vocabulary" autocomplete="off">
            </div>
            <button class="btn-agila-vocca" type="submit">{{__('vocabularies-test.check')}}</button>
        </form>

    </div>

@endsection
