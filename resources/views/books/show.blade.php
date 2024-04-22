@extends('layouts')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">{{ $book->title }}</h1>

        <p>{{ __('This book has [TODO] chapters.') }}</p>

        <div class="mt-6 flex">
            <a href="{{ route('book.edit', ['book' => $book]) }}" class="btn-agila-vocca mr-4">
                <x-ri-pencil-line class="h-5 w-5" />
                <span>{{ __('Edit') }}</span>
            </a>
            <form id="delete-form-{{ $book->id }}" action="{{ route('book.destroy', ['book' => $book]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $book->id }})" class="btn-agila-vocca mr-4">
                    <x-ri-delete-bin-line class="h-5 w-5" />
                    <span>{{ __('Delete') }}</span>
                </button>
            </form>
            <a href="{{route('book.index')}}" class="btn-agila-vocca">
                <x-ri-arrow-go-back-line class="h-5 w-5" />
                <span>{{ __('Cancel') }}</span>
            </a>
        </div>
    </div>

    <script>
        function confirmDelete(bookId) {
            if (confirm('Are you sure you want to delete this book?')) {
                document.getElementById('delete-form-' + bookId).submit();
            }
        }
    </script>
@endsection
