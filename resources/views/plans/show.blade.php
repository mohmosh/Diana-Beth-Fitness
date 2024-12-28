@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="widget-container">
        <div class="widget">
            <h2 class="widget-title">{{ $plan->name }}</h2>
            <p class="widget-text"><strong>Description:</strong> {{ $plan->description }}</p>
            <p class="widget-text"><strong>Price:</strong> ${{ $plan->price }}</p>
            <p class="widget-text"><strong>Workout Limit:</strong> {{ $plan->workout_limit }}</p>
            <p class="widget-text"><strong>Video Limit:</strong> {{ $plan->video_limit }}</p>
            <p class="widget-text"><strong>Testimonial Limit:</strong> {{ $plan->testimonial_limit }}</p>
            <p class="widget-text"><strong>Subscription Type:</strong> {{ $plan->subscription_type == 'personal_training' ? 'Personal Training' : 'Build His Temple' }}</p>
            <div class="widget-actions">
                <a href="{{ route('plans.index') }}" class="btn btn-secondary btn-lg">Back to Plans</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Container for Widgets */
    .widget-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f9f9f9;
    }

    /* Individual Widget Styling */
    .widget {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .widget:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    /* Widget Content */
    .widget-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .widget-text {
        font-size: 1rem;
        margin: 0.5rem 0;
    }

    /* Widget Actions */
    .widget-actions {
        margin-top: 1.5rem;
    }

    .btn-secondary {
        background: white;
        color: #6a11cb;
        border: 2px solid #6a11cb;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #6a11cb;
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .widget {
            padding: 1.5rem;
        }

        .widget-title {
            font-size: 1.5rem;
        }

        .widget-text {
            font-size: 0.9rem;
        }
    }
</style>
@endsection
