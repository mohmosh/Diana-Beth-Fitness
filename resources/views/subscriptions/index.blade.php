@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Choose a Plan</h2>

    <div class="row">
        <div class="col-md-6">
            @foreach ($personalTrainingPlans as $plan)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $plan->name }}</h5>
                    <p class="card-text">{{ $plan->description }}</p>
                    <p class="card-text">Price: ${{ $plan->price }}</p>

                    <form action="{{ route('subscriptions.store') }}" method="POST">

                        @csrf
                        <input type="hidden" name="subscription_type" value="personal_training">

                        {{-- <button type="submit" class="btn btn-primary">Join</button> --}}

                        <a href="{{ route('subscriptions.form', $plan->id) }}" class="btn btn-primary">Join</a>

                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-6">
            @foreach ($buildHisTemplePlans as $plan)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $plan->name }}</h5>
                    <p class="card-text">{{ $plan->description }}</p>
                    <p class="card-text">Price: ${{ $plan->price }}</p>

                    <form action="{{ route('subscriptions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subscription_type" value="build_his_temple">
                        <a href="{{ route('subscriptions.form', $plan->id) }}" class="btn btn-primary">Join</a>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
