<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Training</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center">
            <div class="container">
                <a class="navbar-brand text-white" href="#">Personal Training</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav ml-auto">


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center user-dropdown" href="#" id="userDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/img/logo/logo.png') }}" class="user-avatar rounded-circle mr-2" alt="User">
                                <span class="user-name">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/') }}">Home</a>
                                {{-- <a class="dropdown-item" href="#">Account Settings</a>
                                <a class="dropdown-item" href="#">Need Help?</a> --}}
                                <div class="dropdown-divider"></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </div>
                        </li>



                </div>
            </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">

        <div class="container mt-4">
            <a href="javascript:history.back()" class="btn btn-secondary mb-4">Back</a>
        </div>


        <!-- Video Section -->
        <div class="container mt-4">
            <h1 class="text-center mb-5">Personal Training Videos</h1>

            <div class="row">
                @forelse($videos as $video)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <!-- Video Widget -->
                        <div class="video-widget">
                            <video controls onended="showDoneButton(this)" data-video-id="{{ $video->id }}">
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                {{ $video->title }} - Your browser does not support the video tag.
                            </video>

                            <div class="video-widget-body">
                                <h5 class="widget-title">{{ $video->title }}</h5>
                                <p class="widget-description">{{ Str::limit($video->description, 100) }}</p>
                            </div>

                            <div class="devotional content mt-3" id="devotional-{{ $video->id }}"
                                style="{{ auth()->user()->videos()->where('video_id', $video->id)->wherePivot('watched', true)->exists() ? 'display:block;' : 'display:none;' }}">
                                <h6 class="widget-title text-center">Devotional</h6>
                                @if (Str::endsWith($video->devotional_file, '.pdf'))
                                    <a href="{{ asset('storage/' . $video->devotional_file) }}" target="_blank"
                                        class="btn btn-info">View Devotional (PDF)</a>
                                @elseif (Str::endsWith($video->devotional_file, '.docx'))
                                    <a href="{{ asset('storage/' . $video->devotional_file) }}" target="_blank"
                                        class="btn btn-info">View Devotional (DOCX)</a>
                                @else
                                    <p class="text-muted">No preview available for this devotional file.</p>
                                @endif
                            </div>

                            <!-- Done Button -->
                            <div class="text-center" id="done-btn-{{ $video->id }}"
                                style="{{ auth()->user()->videos()->where('video_id', $video->id)->wherePivot('watched', true)->exists() ? 'display:block;' : 'display:none;' }}">
                                <button class="btn btn-success"
                                    onclick="markVideoDone({{ $video->id }})">Done</button>
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

       <!-- Track Your Progress Section -->
       <div class="mt-4 text-center">

        <!-- Link the button to the track progress page -->
        <a href="{{ route('track.progress') }}" class="btn btn-info btn-lg rounded-circle">Track Your Progress</a>

    </div>
</div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


       <!-- Toggle Progress Form Script -->
       <script>
           function toggleProgressForm() {
               const form = document.getElementById('progress-form');
               const button = document.getElementById('show-form-btn');

               if (form.style.display === "none") {
                   form.style.display = "block";
                   button.textContent = "Hide Progress Form"; // Change button text when form is shown
               } else {
                   form.style.display = "none";
                   button.textContent = "Track Your Progress"; // Reset button text when form is hidden
               }
           }
       </script>

    <script>
        // Function to update progress bar and show the 'Done' button
        function updateProgress(videoId, progress) {
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            const doneBtn = document.getElementById('done-btn-' + videoId);

            // Round the progress to the nearest whole number
            const roundedProgress = Math.floor(progress); // This will remove any decimals

            // Update the progress bar width and percentage
            progressBar.style.width = roundedProgress + '%';
            progressBar.setAttribute('aria-valuenow', roundedProgress);
            progressText.textContent = 'Progress: ' + roundedProgress + '%';

            // Show the 'Done' button once video is finished
            if (roundedProgress >= 100) {
                doneBtn.style.display = 'block';
            }
        }

        // Function to mark the video as done
        function markVideoDone(videoId) {
            // Make an AJAX request to update progress on the server
            fetch('/mark-video-done', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Laravel CSRF token
                    },
                    body: JSON.stringify({
                        videoId: videoId,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Keep devotional and done button visible after marking done
                        const devotionalContent = document.getElementById('devotional-' + videoId);
                        const doneBtn = document.getElementById('done-btn-' + videoId);

                        if (devotionalContent) {
                            devotionalContent.style.display = 'block';
                        }
                        if (doneBtn) {
                            doneBtn.style.display = 'block';
                        }

                        alert('Video marked as done!');
                    } else {
                        alert('Error marking video as done!');
                    }
                });
        }

        // Attach event listener to all video elements to track progress and video completion
        document.querySelectorAll('video').forEach(video => {
            const videoId = video.getAttribute('data-video-id');
            const devotionalContent = document.getElementById('devotional-' + videoId);
            const doneBtn = document.getElementById('done-btn-' + videoId);

            // Event listener to track video progress
            video.addEventListener('timeupdate', function() {
                const duration = video.duration;
                const currentTime = video.currentTime;
                const progress = (currentTime / duration) * 100;
                updateProgress(videoId, progress);
            });

            // Event listener to handle when the video ends
            video.addEventListener('ended', function() {
                if (devotionalContent) {
                    devotionalContent.style.display = 'block';
                }
                if (doneBtn) {
                    doneBtn.style.display = 'block';
                }

                // Automatically mark the video as done on completion
                markVideoDone(videoId);
            });
        });
    </script>
</body>

</html>

<!-- Custom Styles -->
<style>
    /* Navigation Bar */
    .navbar {
        padding: 1.4rem;
        background-color: #8a0f9b;
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
        color: #fbc02d;
        /* text-decoration: underline; */
    }



    .dropdown-menu {
        min-width: 180px;
    }

    .dropdown-menu .dropdown-item {
        padding: 10px 15px;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    .user-avatar {
    width: 70px;
    height: 70px;
}

.user-name {
    font-size: 30px;
    font-weight: bold;
}


    .logout-btn {
        background-color: #d32f2f;
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
        color: #6c757d;
    }

    .video-widget video {
        border-radius: 10px;
        max-height: 200px;
        width: 100%;
    }

    /* Global Section Styling */
    body {
        background-color: #f8f9fa;
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

    .devotionals {
        border-top: 1px solid #ddd;
        padding-top: 20px;
        margin-top: 20px;
    }


    .btn-lg {
        padding: 12px 24px;
        font-size: 18px;
        border-radius: 10px;
        /* Optional: makes the button corners more rounded */
    }
</style>
