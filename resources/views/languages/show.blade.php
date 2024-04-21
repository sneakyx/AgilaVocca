@extends('layouts')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">{{ $language->name }}</h1>

        <p>{{ __('This language is used in [TODO] books.') }}</p>

        <div class="mt-6 flex">
            <a href="{{ route('language.edit', ['language' => $language]) }}" class="btn-agila-vocca mr-4">
                <x-ri-pencil-line class="h-5 w-5" />
                <span>{{ __('Edit') }}</span>
            </a>
            <form id="delete-form-{{ $language->id }}" action="{{ route('language.destroy', ['language' => $language]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $language->id }})" class="btn-agila-vocca mr-4">
                    <x-ri-delete-bin-line class="h-5 w-5" />
                    <span>{{ __('Delete') }}</span>
                </button>
            </form>
            <a href="{{route('language.index')}}" class="btn-agila-vocca">
                <x-ri-arrow-go-back-line class="h-5 w-5" />
                <span>{{ __('Cancel') }}</span>
            </a>
        </div>
    </div>

    <script>
        function confirmDelete(languageId) {
            if (confirm('Are you sure you want to delete this language?')) {
                document.getElementById('delete-form-' + languageId).submit();
            }
        }
    </script>
@endsection
