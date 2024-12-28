@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-5">Choose Your Subscription Plan</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($plans as $plan)
                <div class="col">
                    <div class="widget p-4 shadow-lg rounded text-center bg-light mb-4">
                        <h4 class="text-primary mb-3">{{ $plan->name }}</h4>
                        <p class="text-muted mb-4">{{ $plan->description }}</p>
                        <h5 class="text-success mb-4">${{ $plan->price }} / month</h5>

                        <div class="d-grid gap-2">
                            <a href="{{ route('subscriptions.form', ['plan' => $plan->id]) }}"
                               class="btn btn-lg btn-outline-primary">
                                Subscribe
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .widget {
            background: linear-gradient(135deg, #6a1b9a, #ab47bc);
            color: white;
            transition: transform 0.3s ease-in-out;
        }

        .widget:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .widget h4 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .widget p {
            font-size: 1rem;
            font-weight: lighter;
        }

        .btn-outline-primary {
            background-color: #ffffff;
            color: #6a1b9a;
            border: 2px solid #6a1b9a;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #6a1b9a;
            color: white;
            border-color: #6a1b9a;
        }
    </style>
@endsection
