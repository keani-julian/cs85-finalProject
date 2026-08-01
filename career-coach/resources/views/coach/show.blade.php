@extends('layouts.app')

@section('title', $submission->documentTypeLabel() . ' review — ' . config('app.name'))

@section('content')
    <h1>{{ $submission->documentTypeLabel() }} review</h1>
    <p class="meta">
        <span class="badge">{{ $submission->modeLabel() }}</span>
        <span class="badge">{{ $submission->target_role }}</span>
        {{ $submission->created_at->format('M j, Y \a\t g:i a') }}
    </p>

    <div class="output">{{ $submission->ai_output }}</div>

    <h2>What you submitted</h2>
    <div class="output">{{ $submission->input_text }}</div>

    <div class="actions">
        <a href="{{ route('coach.create') }}">Start another review</a>
        <form method="POST" action="{{ route('coach.destroy', $submission) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="link">Delete this submission</button>
        </form>
    </div>
@endsection
