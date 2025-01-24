<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build His Temple Videos</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">


</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center">

            <div class="container">
                <a class="navbar-brand text-white" href="#">Build His Temple</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.devotionals.index') }}">Devotionals</a>
                        </li>
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

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- User Level and Progress -->
        <div class="text-center mb-4">
            <h5>Your Current Level: <strong>{{ auth()->user()->level }}</strong></h5>
            <p class="text-muted">Advance to the next level to unlock more content.</p>

            <!-- Progress Bar -->
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" id="progress-bar" style="width: 0%"
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    0%
                </div>
            </div>
            <p class="mt-2" id="progress-text">Progress: 0%</p>
        </div>


        <!-- Videos Section -->
        <h5 class="mb-3">Videos and Devotionals for Your Level</h5>
        <div class="row">
            @forelse($videos as $video)
                <div class="col-md-4 mb-4">
                    <div class="video-widget">
                        @if (auth()->user()->level >= $video->level)
                            <!-- Unlocked Video -->
                            <div class="video-thumbnail">
                                <video id="video-{{ $video->id }}" class="rounded mb-2" width="100%" controls
                                    data-video-id="{{ $video->id }}">
                                    <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <p class="text-center">{{ $video->title }}</p>
                            <p class="text-muted text-center">Level {{ $video->level }} unlocked</p>

                            <!-- Devotional Section -->
                            <div class="devotional-content mt-3">
                                <h6 class="widget-title text-center">Devotional</h6>
                                <p class="text-muted">{{ $video->devotional }}</p>
                            </div>

                            <!-- Done Button -->
                            <div class="text-center" id="done-btn-{{ $video->id }}" style="display: none;">
                                <button class="btn btn-success"
                                    onclick="markVideoDone({{ $video->id }})">Done</button>
                            </div>
                        @else
                            <!-- Locked Video -->
                            <div class="video-thumbnail locked">
                                <p>Locked</p>
                            </div>
                            <p class="text-center">{{ $video->title }}</p>
                            <p class="text-danger text-center">Unlock this video by advancing to Level
                                {{ $video->level }}.</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-center">No videos available for your current level.</p>
            @endforelse
        </div>


        <!-- Level Upgrade Button -->
        @if (auth()->user()->level < config('app.max_level', 3))
            <div class="text-center mt-4">
                <form action="{{ route('upgrade.level') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Advance to Next Level</button>
                </form>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to update progress bar and show the 'Done' button
        function updateProgress(videoId, progress) {
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            const doneBtn = document.getElementById('done-btn-' + videoId);

            // Update the progress bar width and percentage
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
            progressText.textContent = 'Progress: ' + progress + '%';

            // Show the 'Done' button once video is finished
            if (progress >= 100) {
                doneBtn.style.display = 'block';
            }
        }

        // Function to mark the video as done
        function markVideoDone(videoId) {
            // Here you would typically send an AJAX request to update the user's progress on the server.
            // For now, we'll just simulate the process by updating the progress.

            alert('Video marked as done! You can now unlock more videos.');

            // For example, increment user's level or unlock next videos
            // Example: window.location.reload(); or send an AJAX request to update the progress in your database.
        }

        // Attach event listener to video element
        document.querySelectorAll('video').forEach(video => {
            video.addEventListener('timeupdate', function() {
                const videoId = video.getAttribute('data-video-id');
                const duration = video.duration;
                const currentTime = video.currentTime;

                const progress = (currentTime / duration) * 100;
                updateProgress(videoId, progress);
            });
        });
    </script>

</body>

</html>
<style>
    body {
        background-color: #f8f9fa;
        /* Light gray background */
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

    .navbar {
        padding: 1.4rem;
        background-color: #8a0f9b;
        /* Distinct purple header */
        color: white;
    }

    .navbar-nav .nav-link {
        font-size: 1rem;
        margin-right: 15px;
        color: white;
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #fbc02d;
        /* Gold highlight on hover */
        text-decoration: underline;
    }

    .logout-btn {
        background-color: #d32f2f;
        /* Red button color */
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .logout-btn:hover {
        background-color: #b71c1c;
        /* Darker red */
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
        background-color: #0c0b0b
    }

    .video-widget .widget-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #6a1b9a;
    }

    .video-widget .widget-description {
        font-size: 0.95rem;
        line-height: 1.5;
        color: #6c757d;
        /* Muted text color */
    }

    .video-widget video {
        border-radius: 10px;
        max-height: 200px;
        width: 100%;
    }


    .progress {
        height: 25px;
    }

    .devotionals {
        border-top: 1px solid #e0e0e0;
        padding-top: 10px;
    }

    .devotional h6 {
        font-size: 1rem;
        font-weight: bold;
    }

    .devotional p {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .devotional a {
        font-size: 0.85rem;
        color: #8a0f9b;
    }

    .devotional a:hover {
        text-decoration: underline;
        color: #6a1b9a;
    }
</style>
