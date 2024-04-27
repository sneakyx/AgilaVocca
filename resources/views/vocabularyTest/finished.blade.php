@extends('layouts')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        Du hast {{$metaInfos['incorrect']}} Fehler bei {{$metaInfos['total']}} Vokabeln gehabt.
        Das sind {{$percentage}} %.
        <br><br>
    </div>

    <div>
        <a href="{{route('vocabulary-test.index')}}" class="btn-agila-vocca btn">Neuer Test</a>
        <a href="{{route('dashboard')}}" class="btn-agila-vocca btn">Zum Dashboard</a>

    </div>
@endsection
