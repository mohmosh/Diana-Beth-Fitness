@extends('layouts.app')

@section('title', 'All Testimonials')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Add the Create Testimonial Button -->
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">Create A Testimonial</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($testimonials as $testimonial)
            <div class="col-md-4">
                <div class="card mb-3">
                    @if($testimonial->photo)
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" class="card-img-top" alt="User Photo">
                    @endif
                    @if($testimonial->video)
                        <video controls class="w-100 mt-2">
                            <source src="{{ asset('storage/' . $testimonial->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                    <div class="card-body">
                        <p class="card-text">{{ $testimonial->content }}</p>
                        <p class="text-muted">By User ID: {{ $testimonial->user_id }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection










{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Testimonials</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        @foreach($testimonials as $testimonial)
        <div class="col-md-4">
            <div class="card mb-3">
                @if($testimonial->photo)
                <img src="{{ asset('storage/' . $testimonial->photo) }}" class="card-img-top" alt="User Photo">
                @endif
                @if($testimonial->video)
                <video controls class="w-100 mt-2">
                    <source src="{{ asset('storage/' . $testimonial->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @endif
                <div class="card-body">
                    <p class="card-text">{{ $testimonial->content }}</p>
                    <p class="text-muted">By User ID: {{ $testimonial->user_id }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection --}}

