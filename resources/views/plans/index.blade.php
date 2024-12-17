@extends('layouts.app')

<main>
@section('content')
    <h1>Available Plans</h1>
    @foreach ($plans as $plan)
        <div>
            <h2>{{ $plan->name }}</h2>
            <p>Price: ${{ $plan->price }}</p>
            <p>Duration: {{ $plan->duration }} days</p>
            <ul>
                @if ($plan->features)
                    @foreach (json_decode($plan->features) as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                @endif
            </ul>
            <a href="{{ route('plans.show', $plan->id) }}">View Details</a>
        </div>
    @endforeach
@endsection
</main>



