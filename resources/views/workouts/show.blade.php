@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $workout->title }}</h2>
        <p>{{ $workout->description }}</p>

        <!-- Show content if the user has access -->
        @if(auth()->user()->subscription->plan->isBasic() && !auth()->user()->accessibleWorkouts->contains($workout))
            <p>This workout is for bronze subscription only. <a href="{{ route('subscriptions.upgrade') }}">Upgrade your subscription</a> to view more workouts.</p>
        @elseif(auth()->user()->subscription->plan->isSilver() && !$workout->isSilver())
            <p>This workout is for silver subscription only. <a href="{{ route('subscriptions.upgrade') }}">Upgrade your subscription</a> to view more workouts.</p>
        @elseif(auth()->user()->subscription->plan->isGold())
            <!-- Show workout content for gold users -->
            <div class="workout-content">
                <!-- Detailed workout content -->
            </div>
        @endif
    </div>
@endsection
