@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="black-white mb-4">Workouts</h1>

    @if($videos->isEmpty())
        <p class="alert alert-info">No videos available for your subscription plan. Upgrade to access more content!</p>
    @else
        <div class="row">
            @foreach($videos as $video)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <video width="100%" controls class="p-2">
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $video->title }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(Auth::user()->plan_id < 3)
        <div class="mt-4">
            <p class="alert alert-warning">
                Want to access more workouts?
                <a href="{{ route('plans.index') }}" class="btn btn-primary">Upgrade Your Plan</a>
            </p>
        </div>
    @endif
</div>
@endsection
