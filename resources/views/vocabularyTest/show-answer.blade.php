@extends('layouts')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            @if ($howGoodWasAnswer==='correct')
                Super, die Antwort war richtig!<br>
            @else
                @if($howGoodWasAnswer==='nearby')
                    Die Antwort war fast richtig!
                @else
                    Die Antwort war komplett falsch!
                @endif
                <hr>
                @if ($metaInfos['test_foreign'])
                        <b>{{$vocabulary->native}}</b> heisst auf {{$metaInfos['foreign_language']}}: <b>{{$vocabulary->foreign}}</b>
                @else
                        <b>{{$vocabulary->foreign}}</b> heisst auf {{$metaInfos['native_language']}}: <b>{{$vocabulary->native}}</b>
                @endif
                 - Deine Eingabe war: <span style="color: darkred;"> {{$phraseFromUser}}</span>
            @endif

        </div>
        @if ($howGoodWasAnswer==='correct')

            <p>Die Seite wird in <span id="countdown">10</span> Sekunden umgeleitet. Drücken Sie eine Taste, um sofort umgeleitet zu werden.</p>
        @else
            <p>Drücken Sie eine Taste, um umgeleitet zu werden.</p>
        @endif
        <button class="btn-agila-vocca" id="next"> {{__('vocabularies-test.next')}}</button>

        <script>

            function redirectToRoute() {
                @if ($howGoodWasAnswer==='correct')
                clearInterval(countdownInterval);
                @endif
                window.location.href = '{{ route("vocabulary-test.form") }}';
            }
            @if ($howGoodWasAnswer==='correct')

                var countdownElement = document.getElementById('countdown');
                var secondsRemaining = 10;
                var countdownInterval = setInterval(function () {
                    secondsRemaining--;
                    countdownElement.textContent = secondsRemaining;
                    if (secondsRemaining <= 0) {
                        redirectToRoute();
                    }
                }, 1000);
            @endif
            // Umleitung beim Drücken einer Taste
            document.addEventListener('keydown', function () {
                redirectToRoute();
            });
            document.getElementById("next").addEventListener("click", function() {
                redirectToRoute();
            });
        </script>
    </div>

@endsection
