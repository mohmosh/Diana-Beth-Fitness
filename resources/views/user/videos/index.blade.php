@extends('layouts.app') <!-- Your layout file -->

@section('content')
<div class="container">
    <h1>Workouts</h1>

    @if($videos->isEmpty())
        <p>No videos available at the moment.</p>
    @else
        <div class="row">
            @foreach($videos as $video)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

