@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">{{ $plan->name }}</h2>
            <p class="card-text"><strong>Description:</strong> {{ $plan->description }}</p>
            <p class="card-text"><strong>Price:</strong> ${{ $plan->price }}</p>
            <p class="card-text"><strong>Workout Limit:</strong> {{ $plan->workout_limit }}</p>
            <p class="card-text"><strong>Video Limit:</strong> {{ $plan->video_limit }}</p>
            <p class="card-text"><strong>Testimonial Limit:</strong> {{ $plan->testimonial_limit }}</p>
            <p class="card-text"><strong>Subscription Type:</strong> {{ $plan->subscription_type == 'personal_training' ? 'Personal Training' : 'Build His Temple' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('plans.index') }}" class="btn btn-secondary">Back to Plans</a>
        </div>
    </div>
</div>
@endsection
