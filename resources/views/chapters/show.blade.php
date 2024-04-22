@extends('layouts')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">{{ $chapter->title }}</h1>

        <p>{{ __('This chapter has [TODO] vocabularies.') }}</p>

        <div class="mt-6 flex">
            <a href="{{ route('chapter.edit', ['chapter' => $chapter]) }}" class="btn-agila-vocca mr-4">
                <x-ri-pencil-line class="h-5 w-5" />
                <span>{{ __('Edit') }}</span>
            </a>
            <form id="delete-form-{{ $chapter->id }}" action="{{ route('chapter.destroy', ['chapter' => $chapter]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $chapter->id }})" class="btn-agila-vocca mr-4">
                    <x-ri-delete-bin-line class="h-5 w-5" />
                    <span>{{ __('Delete') }}</span>
                </button>
            </form>
            <a href="{{route('chapter.index')}}" class="btn-agila-vocca">
                <x-ri-arrow-go-back-line class="h-5 w-5" />
                <span>{{ __('Cancel') }}</span>
            </a>
        </div>
    </div>

    <script>
        function confirmDelete(chapterId) {
            if (confirm('Are you sure you want to delete this chapter?')) {
                document.getElementById('delete-form-' + chapterId).submit();
            }
        }
    </script>
@endsection
