<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container mt-4">
            <a href="{{ route('testimonials.index') }}" class="btn btn-secondary mb-4">Back to All Testimonials</a>

            <!-- Testimonial Card -->
            <div class="card mb-4">
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

                <div class="card-body">
                    <!-- Testimonial Content -->
                    <h3 class="card-title">{{ $testimonial->content }}</h3>
                    <p class="card-text">{{ $testimonial->content }}</p>
                    <p class="text-muted">By User ID: {{ $testimonial->user_id }}</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Optional Bootstrap JS (for functionality like modals, dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<style>
    .testimonial-card {
        max-width: 100px;
        margin: 0 auto;
        border-radius: 10px;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 1rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #555;
    }

    .btn-secondary {
        margin-top: 20px;
    }
</style>
