@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($plans as $plan)
            <h1>{{ $plan->name }}</h1>
            <p>Price: ${{ $plan->price }}</p>
            <p>Duration: {{ $plan->duration }} days</p>
            <ul>
                @if ($plan->features)
                    @foreach (json_decode($plan->features) as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                @endif
            </ul>
            @if (auth()->check() && auth()->user()->subscription_plan !== $plan->name)
                <form method="POST" action="{{ route('subscriptions.subscribe', $plan->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            @else
                <span class="text-success">Subscribed</span>
            @endif
        @endforeach
    </div>
@endsection
