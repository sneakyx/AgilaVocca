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
                <br>
                @if ($metaInfos['test_foreign'])
                    {{$vocabulary->native}} heisst auf {{$metaInfos['foreign_language']}}: {{$vocabulary->foreign}}
                @else
                    {{$vocabulary->foreign}} heisst auf {{$metaInfos['native_language']}}: {{$vocabulary->native}}
                @endif
                 - Deine Eingabe war: {{$phraseFromUser}}
            @endif

        </div>
        @if ($howGoodWasAnswer==='correct')

            <p>Die Seite wird in <span id="countdown">10</span> Sekunden umgeleitet. Drücken Sie eine Taste, um sofort umgeleitet zu werden.</p>
        @else
            <p>Drücken Sie eine Taste, um umgeleitet zu werden.</p>
        @endif
        <script>

            function redirectToRoute() {
                window.location.href = '{{ route("vocabulary-test.form") }}';
            }
            @if ($howGoodWasAnswer==='correct')

                var countdownElement = document.getElementById('countdown');
                var secondsRemaining = 10;
                var countdownInterval = setInterval(function () {
                    secondsRemaining--;
                    countdownElement.textContent = secondsRemaining;
                    if (secondsRemaining <= 0) {
                        clearInterval(countdownInterval);
                        redirectToRoute();
                    }
                }, 1000);
            @endif
            // Umleitung beim Drücken einer Taste
            document.addEventListener('keydown', function () {
                @if ($howGoodWasAnswer==='correct')
                    clearInterval(countdownInterval);
                @endif
                redirectToRoute();
            });
        </script>
    </div>

@endsection
