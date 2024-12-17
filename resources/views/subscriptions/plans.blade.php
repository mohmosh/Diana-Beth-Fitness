@extends('layouts.app')

@section('content')
    <h1>Choose a Subscription Plan</h1>
    <div class="plans">
        @foreach ($plans as $plan)
            <div class="plan">
                <h2>{{ $plan->name }}</h2>
                <p>{{ $plan->description }}</p>
                <p>Price: ${{ $plan->price }}</p>
                <form method="POST" action="{{ route('subscribe.process', $plan->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection



