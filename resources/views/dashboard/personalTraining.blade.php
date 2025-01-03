<div class="container mt-4">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand text-success font-weight-bold" href="#">My Training</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('user.devotionals.index') }}">Devotionals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Video Section -->
    <h1 class="text-center text-success mb-5">Personal Training Videos</h1>

    <div class="row">
        @forelse($videos as $video)
            <div class="col-lg-4 col-md-6 mb-4">
                <!-- Video Widget -->
                <div class="video-widget bg-white p-3 rounded shadow-sm overflow-hidden">
                    <video width="100%" controls class="rounded mb-3">
                        <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                        {{ $video->title }} - Your browser does not support the video tag.
                    </video>
                    <div class="video-widget-body">
                        <h5 class="widget-title text-primary font-weight-bold mb-2">{{ $video->title }}</h5>
                        <p class="widget-description text-muted">{{ Str::limit($video->description, 100) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-danger">No videos available for Personal Training.</p>
            </div>
        @endforelse
    </div>
</div>

@push('styles')
    <style>
        /* Navigation Bar */
        .navbar-brand {
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #28a745;
        }

        /* Video Widget */
        .video-widget {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .video-widget:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .video-widget-body {
            padding-top: 15px;
        }

        .video-widget .widget-title {
            font-size: 1.1rem;
        }

        .video-widget .widget-description {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .video-widget video {
            border-radius: 15px;
        }
    </style>
@endpush
