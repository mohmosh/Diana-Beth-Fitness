<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Training Videos</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center">
            <div class="container">
                <a class="navbar-brand text-white" href="#">My Training</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">

                        <div class="mx-auto">
                            <a class="nav-link text-white text-center" href="{{ route('user.devotionals.index') }}">Devotionals</a>
                        </div>

                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="logout-btn">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Video Section -->
        <div class="container mt-4">
            <h1 class="text-center mb-5">Personal Training Videos</h1>
            <div class="row">
                @forelse($videos as $video)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <!-- Video Widget -->
                        <div class="video-widget">
                            <video controls>
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                {{ $video->title }} - Your browser does not support the video tag.
                            </video>
                            <div class="video-widget-body">
                                <h5 class="widget-title">{{ $video->title }}</h5>
                                <p class="widget-description">{{ Str::limit($video->description, 100) }}</p>
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
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


    <!-- Custom Styles -->
    <style>
        /* Navigation Bar */
        .navbar {
            padding: 1.4rem;
            background-color: #8a0f9b; /* Distinct purple header */
            color: white;
        }

        .navbar-brand {
            font-size: 1.7rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
            margin-right: 15px;
            color: white;
            transition: color 0.3s ease, text-decoration 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #fbc02d; /* Gold highlight on hover */
            text-decoration: underline;
        }

        .logout-btn {
            background-color: #d32f2f; /* Red button color */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .logout-btn:hover {
            background-color: #b71c1c; /* Darker red */
            transform: scale(1.05);
        }

        /* Video Widget */
        .video-widget {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .video-widget:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .video-widget-body {
            padding: 10px;
        }

        .video-widget .widget-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #6a1b9a;
        }

        .video-widget .widget-description {
            font-size: 0.95rem;
            line-height: 1.5;
            color: #6c757d; /* Muted text color */
        }

        .video-widget video {
            border-radius: 10px;
            max-height: 200px;
            width: 100%;
        }

        /* Global Section Styling */
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Roboto', sans-serif;
        }

        h1 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            color: #6a1b9a;
        }

        p.text-danger {
            font-size: 1rem;
        }
    </style>
