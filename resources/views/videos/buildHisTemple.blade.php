@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Build His Temple - Level {{ auth()->user()->current_level }}</h1>

    @if ($videos->count() > 0)
        @foreach ($videos as $video)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $video->title }}</h5>
                    <p class="card-text">{{ $video->description }}</p>
                    <a href="{{ optional($video->url)->url }}" target="_blank" class="btn btn-primary">Watch Video</a>
                </div>
            </div>
        @endforeach
    @else
        <p>No videos available for this level.</p>
    @endif

    <form method="POST" action="{{ route('videos.requestLevelJump') }}">
        @csrf
        <button type="submit" class="btn btn-warning mt-3">Request Level Jump</button>
    </form>
</div>
@endsection
