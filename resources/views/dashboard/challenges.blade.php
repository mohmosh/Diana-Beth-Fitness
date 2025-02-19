@extends('layouts.app')

@section('content')

    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center pt-70">
                            <h2>Your Workouts</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Main Content -->
<main>
    <div class="container mt-4">
            <h1 class="text-center mb-5">Challenges</h1>

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

                                style="{{ auth()->check() && auth()->user()->videos()->where('video_id', $video->id)->wherePivot('watched', true)->exists() ? 'display:block;' : 'display:none;' }}"

                                @if (Str::endsWith($video->devotional_file, '.pdf'))>
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
                                style="{{ auth()->check() && auth()->user()->videos()->where('video_id', $video->id)->wherePivot('watched', true)->exists() ? 'display:block;' : 'display:none;' }}">
                                <button class="btn btn-success"
                                    onclick="markVideoDone({{ $video->id }})">Done</button>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-danger">No videos available for Challenges.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</main>

@push('styles')
<style>
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

@push('scripts')

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
