@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Personal Training Videos</h1>

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
        <p>No videos available for Personal Training.</p>
    @endif
</div>
@endsection