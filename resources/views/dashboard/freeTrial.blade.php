@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Free Trial Videos</h1>
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <!-- Video Section -->
                        <video width="100%" controls>
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <p class="card-text">{{ $video->description }}</p>
                        </div>

                        <!-- Devotionals Section -->
                        <div class="card-footer">
                            <h6 class="text-muted">Devotionals:</h6>
                            @forelse ($video->devotionals as $devotional)
                                <div class="devotional mb-2">
                                    <h6 class="text-primary">{{ $devotional->title }}</h6>
                                    <p>{{ Str::limit($devotional->content, 100) }}</p>
                                    <a href="#" class="btn btn-sm btn-link">Read More</a>
                                </div>
                            @empty
                                <p class="text-muted">No devotionals available for this video.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
