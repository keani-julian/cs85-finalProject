@extends('layouts.app')

@section('title', 'New review — ' . config('app.name'))

@section('content')
    <h1>Get coaching on your application</h1>
    <p class="lede">Paste a resume or cover letter, name the role you are going for, and choose whether you want feedback or a rewrite.</p>

    @if ($errors->any())
        <div class="alert">
            <strong>Please fix the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('coach.store') }}" class="card">
        @csrf

        <div class="row">
            <div class="field">
                <label for="document_type">What are you submitting?</label>
                <select name="document_type" id="document_type">
                    @foreach ($documentTypes as $value => $label)
                        <option value="{{ $value }}" @selected(old('document_type') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('document_type')<p class="err">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label for="mode">What do you want back?</label>
                <select name="mode" id="mode">
                    @foreach ($modes as $value => $label)
                        <option value="{{ $value }}" @selected(old('mode') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('mode')<p class="err">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="field">
            <label for="target_role">Target role</label>
            <input type="text" name="target_role" id="target_role" value="{{ old('target_role') }}" placeholder="Marketing Coordinator">
            @error('target_role')<p class="err">{{ $message }}</p>@enderror
        </div>

        <div class="field">
            <label for="input_text">Your text <span class="hint">(at least 100 characters)</span></label>
            <textarea name="input_text" id="input_text" placeholder="Paste your resume or cover letter here...">{{ old('input_text') }}</textarea>
            @error('input_text')<p class="err">{{ $message }}</p>@enderror
        </div>

        <button type="submit">Get coaching</button>
    </form>
@endsection
