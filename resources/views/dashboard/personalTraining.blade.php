@extends('layouts.app')
{{--
@section('content')
<div class="container mt-4">
    <h1 class="text-center text-success">Personal Training Videos</h1>

    <div class="row">
        @forelse($videos as $video)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <video width="100%" controls class="card-img-top" alt="Video: {{ $video->title }}">
                        <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                        {{ $video->title }} - Your browser does not support the video tag.
                    </video>
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $video->title }}</h5>
                        <p class="card-text">{{ $video->description }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-danger">No videos available for Personal Training.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection --}}
