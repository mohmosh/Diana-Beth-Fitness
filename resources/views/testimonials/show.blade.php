@extends('layouts.app')

@section('content')
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center pt-70">
                            <h2>Testimonials</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="container mt-4">
            <a href="{{ route('testimonials.index') }}" class="btn btn-secondary mb-4">Back to All Testimonials</a>

            <!-- Testimonial Card -->
            <div class="col-md-3">
                @if($testimonial->photo)
                    <img src="{{ asset('storage/' . $testimonial->photo) }}" class="card-img-top" alt="User Photo">
                @endif

                <!-- Display video if available -->
                @if($testimonial->video)
                    <video controls class="w-100 mt-2">
                        <source src="{{ asset('storage/' . $testimonial->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif

                <div class="text-center">
                    <!-- Testimonial Content -->
                    <h3 class="card-title">{{ $testimonial->content }}</h3>
                    <p class="card-text">{{ $testimonial->content }}</p>
                    <p class="text-muted">By {{ $testimonial->user?->name ?? 'Unknown' }}</p>
                </div>
            </div>
        </div>
    </main>



@endsection


@push('styles')
    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #650781);
        }

        .testimonial-widget {
            background: white;
            padding: 20px;
            border-radius: 12px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            text-align: center;
            min-height: 250px;
            cursor: pointer;
        }

        .testimonial-widget:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        a.text-decoration-none {
            color: inherit;
            /* Keeps default text color */
            text-decoration: none;
        }

        a.text-decoration-none:hover {
            text-decoration: none;
        }

        .testimonial-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid #650781;
        }

        .testimonial-video {
            max-height: 180px;
            object-fit: cover;
        }

        .text-muted {
            font-size: 14px;
        }




        h1 {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .text {
            color: black;
        }

        .btn-btn {
            background-color: purple;
            color: whitesmoke;
        }

        .text-center {
            margin-top: 8px;
        }
    </style>

    @push('scripts')

        <!-- Bootstrap JS and Dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
