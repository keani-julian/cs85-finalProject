@extends('layouts.app')

@section('title', 'History — ' . config('app.name'))

@section('content')
    <h1>Past reviews</h1>
    <p class="lede">Everything you have run through the coach, newest first.</p>

    @if (session('status'))
        <div class="notice">{{ session('status') }}</div>
    @endif

    <div class="card">
        @if ($submissions->isEmpty())
            <p class="empty">Nothing here yet. <a href="{{ route('coach.create') }}">Run your first review.</a></p>
        @else
            <ul class="subs">
                @foreach ($submissions as $submission)
                    <li>
                        <a href="{{ route('coach.show', $submission) }}">
                            {{ $submission->documentTypeLabel() }} for {{ $submission->target_role }}
                        </a>
                        <p class="meta" style="margin:4px 0 0;">
                            <span class="badge">{{ $submission->modeLabel() }}</span>
                            {{ $submission->created_at->diffForHumans() }}
                        </p>
                        <p class="excerpt">{{ $submission->excerpt() }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    @if ($submissions->hasPages())
        <div class="pager">{{ $submissions->links() }}</div>
    @endif
@endsection
