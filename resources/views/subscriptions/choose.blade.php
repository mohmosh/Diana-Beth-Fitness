@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Personal Training Plans Section -->
        <div class="subscription-section mb-5">
            <h2 class="text-center mb-4">Personal Training Plans</h2>
            <div class="row g-4">
                @foreach ($plans as $plan)
                    @if ($plan->subscription_type == 'personal_training')
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="widget p-4 text-center shadow-sm">
                                <h4 class="plan-name">{{ $plan->name }}</h4>
                                <p class="plan-description">{{ $plan->description }}</p>
                                <h5 class="plan-price">${{ $plan->price }} / month</h5>
                                <div class="plan-action">
                                    @if (auth()->check() && auth()->user()->subscription_type !== $plan->subscription_type)
                                        <form method="POST" action="{{ route('subscriptions.store') }}">
                                            @csrf
                                            <input type="hidden" name="subscription_type" value="personal_training">
                                            <button type="submit" class="btn btn-lg btn-primary">Subscribe</button>
                                        </form>
                                    @else
                                        <button class="btn btn-lg btn-success" disabled>Subscribed</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Build His Temple Plans Section -->
        <div class="subscription-section">
            <h2 class="text-center mb-4">Build His Temple Plans</h2>
            <div class="row g-4">
                @foreach ($plans as $plan)
                    @if ($plan->subscription_type == 'build_his_temple')
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="widget p-4 text-center shadow-sm">
                                <h4 class="plan-name">{{ $plan->name }}</h4>
                                <p class="plan-description">{{ $plan->description }}</p>
                                <h5 class="plan-price">${{ $plan->price }} / month</h5>
                                <div class="plan-action">
                                    @if (auth()->check() && auth()->user()->subscription_type !== $plan->subscription_type)
                                        <form method="POST" action="{{ route('subscriptions.store') }}">
                                            @csrf
                                            <input type="hidden" name="subscription_type" value="build_his_temple">
                                            <button type="submit" class="btn btn-lg btn-primary">Subscribe</button>
                                        </form>
                                    @else
                                        <button class="btn btn-lg btn-success" disabled>Subscribed</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .widget {
            background: linear-gradient(135deg, #f9f9f9, #e9ecef);
            color: #333;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .widget:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .plan-name {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .plan-description {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .plan-price {
            font-size: 1.25rem;
            color: #28a745;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #003b80);
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #218838);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 5px;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
        }

        .subscription-section {
            padding: 2rem 0;
        }

        .subscription-section h2 {
            color: #343a40;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .plan-name {
                font-size: 1.25rem;
            }

            .plan-price {
                font-size: 1.15rem;
            }

            .btn-primary,
            .btn-success {
                font-size: 1rem;
                padding: 8px 15px;
            }
        }
    </style>
@endsection
