@extends('layouts.app')

<main>
@section('content')
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
        @if (auth()->check())
            <form method="POST" action="{{ route('subscriptions.plans', $plan->id) }}">
                @csrf
                <button type="submit">Subscribe</button>
            </form>
        @endif
    @endforeach
@endsection
</main>

