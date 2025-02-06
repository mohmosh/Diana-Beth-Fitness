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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg navbar-light  fixed-top">
    <div class="container">
        <div class="container mt-4">
            <a href="javascript:history.back()" class="btn btn-secondary mb-4">Back</a>
        </div>
        </li>

        </ul>
</nav>

<body>
    <!-- Main Content -->
    <div class="container mt-4">

        <div class="container mt-4">
            <a href="javascript:history.back()" class="btn btn-secondary mb-4">Back</a>
        </div>


        <!-- Track Your Progress Section -->
        <div class="mt-4 text-center">
            <h5>Track Your Progress</h5>
            <!-- Button to toggle form visibility -->
            <button id="show-form-btn" class="btn btn-info rounded-circle" onclick="toggleProgressForm()">Track Your
                Progress</button>

            <!-- Form to Update Progress -->
            <div id="progress-form"
                style="display: none; margin-top: 20px; max-width: 500px; margin-left: auto; margin-right: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9;">



                @php
                    $progress = auth()->user()->progress()->orderBy('created_at', 'asc')->get();
                @endphp

                @if ($progress->isNotEmpty())
                    <h3>My Progress History</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Starting Weight</th>
                                <th>Closing Weight</th>
                                <th>Progress Date</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($progress as $entry)
                                <tr>
                                    <td>{{ $entry->starting_weight }}</td>
                                    <td>{{ $entry->closing_weight }}</td>
                                    <td>{{ $entry->progress_date }}</td>
                                    <td>{{ $entry->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No progress records found. Please add progress.</p>
                @endif

                @php
                    $latestProgress = auth()->user()->progress()->latest()->first();
                @endphp

                @if ($latestProgress)
                    <!-- Form to Update Progress -->
                    <form action="{{ route('progress.update', $latestProgress->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="start_weight">Starting Weight (kg):</label>
                            <input type="number" class="form-control" id="start_weight" name="start_weight"
                                value="{{ $latestProgress->starting_weight ?? '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="closing_weight">Closing Weight (kg):</label>
                            <input type="number" class="form-control" id="closing_weight" name="closing_weight"
                                value="{{ $latestProgress->closing_weight ?? '' }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Weight</button>
                    </form>
                @else
                    <!-- Form to Add New Progress -->
                    <form action="{{ route('progress.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="starting_weight">Starting Weight (kg):</label>
                            <input type="number" class="form-control" id="starting_weight" name="starting_weight"
                                placeholder="Enter your start weight" required>
                        </div>

                        <div class="form-group">
                            <label for="closing_weight">Closing Weight (kg):</label>
                            <input type="number" class="form-control" id="closing_weight" name="closing_weight"
                                placeholder="Enter your closing weight">
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Add Progress</button>
                    </form>
                @endif
            </div>
            <!-- Scripts -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
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
<style>
    body {
        padding-top: 80px;

    }


    .container {
        margin-top: 20px;
    }

    .navbar {
        font-size: 1.3rem;
        padding: 1.2rem 0;
        background-color: purple;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .navbar-nav .nav-link {
        padding: 0.8rem 1rem;
       
    }


</style>
