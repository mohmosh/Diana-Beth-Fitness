@extends('layouts.app')

@section('content')
<main>
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container ">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center pt-70">
                            <h2>Plans</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container my-5">
        <h2 class="text-center mb-5">Choose Your Subscription Plan</h2>

        <div class="d-flex justify-content-center">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($plans as $plan)
                    <div class="col">
                        <div class="widget p-4 shadow-lg rounded text-center bg-light mb-4" style="height: 300px;">
                            <h4 class="text-primary mb-3">{{ $plan->name }}</h4>
                            <p class="text-muted mb-4">{{ $plan->description }}</p>
                            <h5 class="text-success mb-4">${{ $plan->price }} / month</h5>

                            <div class="d-grid gap-2" style="position: relative; bottom: 20px;">
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
    </div>
</main>
@endsection
