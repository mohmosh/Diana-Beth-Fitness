<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


    <main>
        <div class="container mt-4">
            <h1 class="text-center fw-bold mb-4 text">Testimonials</h1>

            <div class="container mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary mb-4">Back</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="row justify-content-center">
                @forelse($testimonials as $testimonial)
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 rounded-3 mb-4">
                        <!-- Make the whole card clickable -->
                        <a href="{{ route('testimonials.show', $testimonial->id) }}">
                            @if($testimonial->photo)
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" class="card-img-top rounded-top" alt="User Photo">
                            @endif

                            @if($testimonial->video)
                            <video controls class="w-100 mt-2 rounded">
                                <source src="{{ asset('storage/' . $testimonial->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            @endif
                        </a>

                        <div class="card-body text-center p-3">
                            <p class="card-text text-dark fst-italic">{{ Str::limit($testimonial->content, 100) }}...</p>
                            <p class="text-muted small fw-bold">By User Name: {{ $testimonial->user_id }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No testimonials found. Be the first to share your experience!</p>
                </div>
                @endforelse
            </div>

            <div class="text-center">
                {{ $testimonials->links('pagination::bootstrap-4') }}
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('testimonials.create') }}" class="btn btn-lg btn-btn shadow-sm">Create A Testimonial</a>
            </div>
        </div>


<style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #650781);
    }
    .card {
        transition: transform 0.3s ease-in-out;
        height: 100%;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    h1 {
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .text {
        color: black;
    }

    .btn-btn{
        background-color: purple;
        color: whitesmoke;
    }
</style>
</main>

</body>
</html>
