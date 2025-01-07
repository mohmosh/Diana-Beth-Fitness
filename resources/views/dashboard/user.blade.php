@extends('layouts.app')

@section('content')
<main>
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container ">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center pt-70">
                            <h2>Welcome</h2>
                            <p style="font-size: 2.5rem; font-weight: bold; color: #fff;">Your fitness journey starts here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Widgets Section -->
    <div class="container text-center mt-5">
        <div class="row">
            <!-- Subscribe Widget -->
            <div class="col-md-4 mb-4">
                <div class=" bf-services h-100">
                    <div class="card-body">
                        <h5 class="card-title">Subscribe to Our Plans</h5>
                        <p class="card-text">Choose the best plan that fits your needs and start your fitness journey.</p>
                        <a href="{{ route('plans.index') }}" class="btn btn-primary">Subscribe Now</a>
                    </div>
                </div>
            </div>

            <!-- Devotionals Widget -->
            <div class="col-md-4 mb-4">
                <div class=" bf-services h-100">
                    <div class="card-body">
                        <h5 class="card-title">View Devotionals</h5>
                        <p class="card-text">Get inspired and stay motivated with our daily devotionals.</p>
                        <a href="{{ route('user.devotionals.index') }}" class="btn btn-primary">View Devotionals</a>
                    </div>
                </div>
            </div>

            <!-- Communities Widget -->
            <div class="col-md-4 mb-4">
                <div class=" bf-services h-100">
                    <div class="card-body">
                        <h5 class="card-title">See Our Communities</h5>
                        <p class="card-text">Join our vibrant communities and connect with like-minded individuals.</p>
                        {{-- <a href="{{ route('communities.index') }}" class="btn btn-primary">Join Now</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection


<style>
    .dbf-services {
    background-color: #fff;
    min-height: 100px; /* Adjust this value as needed */
}

</style>











