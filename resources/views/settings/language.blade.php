@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('settings.language-settings') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/settings/language') }}">
                        @method('PUT')
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="native_language" class="col-md-4 col-form-label text-md-right">
                                {{ __('settings.select-your-language') }}
                            </label>

                            <div class="col-md-6">
                                <select id="native_language" class="form-control @error('native_language') is-invalid @enderror" name="native_language" required>
                                    @foreach ($languages as $code => $name)
                                        <option value="{{ $code }}" {{ auth()->user()->native_language === $code ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('native_language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('settings.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection