@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Welcome to Your Dashboard</h1>
    <p class="text-center">Explore our content and choose a subscription plan that suits you.</p>

    <!-- Content Section -->
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h2>Exclusive Fitness Content</h2>
            <p>Access a variety of workouts, diet plans, and community support to help you achieve your fitness goals.</p>
        </div>
    </div>

    <!-- Subscription Plans Section -->
    <div class="row mt-5">
        <h2 class="text-center mb-4">Subscription Plans</h2>

        @foreach ($plans as $plan)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header text-center bg-primary text-white">
                        <h3>{{ $plan['name'] }}</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="text-center text-success">${{ $plan['price'] }}/month</h4>
                        <ul>
                            @foreach ($plan['features'] as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Subscribe</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
