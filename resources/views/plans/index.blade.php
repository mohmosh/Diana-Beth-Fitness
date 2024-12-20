@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subscription Plans</h2>
    <div class="row">
        @foreach ($plans as $plan)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $plan->name }}</h5>
                    <p class="card-text">{{ $plan->description }}</p>
                    <p class="card-text">Price: ${{ $plan->price }}</p>

                    
{{--
                    @if($user->subscription_type !== $plan->subscription_type)
                    <a href="{{ route('subscriptions.choose', ['subscription_type' => $plan->subscription_type]) }}" class="btn btn-primary">Choose {{ $plan->subscription_type == 'personal_training' ? 'Personal Training' : 'Build His Temple' }} Plan</a>
                    @else
                    <span class="text-success">Subscribed</span>
                    @endif --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
