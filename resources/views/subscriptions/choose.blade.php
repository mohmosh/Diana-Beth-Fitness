@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Personal Training Plans Section -->
    <div class="subscription-section">
        <h2>Personal Training Plans</h2>
        @foreach ($plans as $plan)
            @if ($plan->subscription_type == 'personal_training')
                <div class="plan-card">
                    <h3>{{ $plan->name }}</h3>
                    <p>Price: ${{ $plan->price }}</p>

                    @if (auth()->check() && auth()->user()->subscription_type !== $plan->subscription_type)
                        <form method="POST" action="{{ route('subscriptions.store') }}">
                            @csrf
                            <input type="hidden" name="subscription_type" value="personal_training">
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </form>
                    @else
                        <span class="text-success">Subscribed</span>
                    @endif
                </div>
            @endif
        @endforeach
    </div>

    <!-- Build His Temple Plans Section -->
    <div class="subscription-section">
        <h2>Build His Temple Plans</h2>
        @foreach ($plans as $plan)
            @if ($plan->subscription_type == 'build_his_temple')
                <div class="plan-card">
                    <h3>{{ $plan->name }}</h3>
                    <p>Price: ${{ $plan->price }}</p>
                    
                    @if (auth()->check() && auth()->user()->subscription_type !== $plan->subscription_type)
                        <form method="POST" action="{{ route('subscriptions.store') }}">
                            @csrf
                            <input type="hidden" name="subscription_type" value="build_his_temple">
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </form>
                    @else
                        <span class="text-success">Subscribed</span>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
