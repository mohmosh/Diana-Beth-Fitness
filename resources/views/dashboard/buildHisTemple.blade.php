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

<main>
    <!-- Main Content -->
    <div class="container mt-5">

        @foreach($plans as $plan)

        <div class="row">


            @if($plan->subscription_type == 'build_his_temple')

            <h3>{{ $plan->name }}</h3>

            @forelse($plan->videos as $video)
            <div class="col-lg-4 col-md-4 mb-4">
                <!-- Video Widget -->
                <div class="video-widget">
                    @if (auth()->user()->level >= $video->level || $video->level == 1)
                    <!-- Unlocked Video -->
                    <div class="video-thumbnail">
                        <video id="video-{{ $video->id }}" class="rounded mb-2 w-100"
                            controls controlsList="nodownload"
                            data-video-id="{{ $video->id }}">
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <div class="video-widget-body">
                        <h5 class="widget-title">{{ $video->title }}</h5>
                        <!-- <p class="widget-description">Level {{ $video->level }} unlocked</p> -->
                    </div>

                    <!-- Devotional Content -->
                    <div class="devotional content mt-3" id="devotional-{{ $video->id }}"
                        style="{{ auth()->user()->videos()->where('video_id', $video->id)->wherePivot('watched', true)->exists() ? 'display:block;' : 'display:none;' }}">
                        <h6 class="widget-title text-center">Devotional</h6>
                        @if (Str::endsWith($video->devotional_file, '.pdf'))
                        <a href="{{ asset('storage/' . $video->devotional_file) }}" target="_blank"
                            class="btn btn-info btn-block">View Devotional (PDF)</a>
                        @elseif (Str::endsWith($video->devotional_file, '.docx'))
                        <!-- <a href="{{ asset('storage/' . $video->devotional_file) }}" target="_blank" -->
                        <!-- class="btn btn-info btn-block">View Devotional (DOCX)</a> -->
                        <!-- <a href="/view_devotional" target="_blank"
                            class="btn btn-info btn-block">View Devotional</a> -->

                        <a href="{{ url('/view_video_devotional/' . $video->id) }}" class="btn btn-primary" target="_blank">
                            View Devotional
                        </a>
                        @else
                        <p class="text-muted text-center">No preview available for this devotional file.
                        </p>
                        @endif
                    </div>

                    <!-- Done Button -->
                    <div class="text-center mt-3" id="done-btn-{{ $video->id }}"
                        style="{{ auth()->user()->videos()->where('video_id', $video->id)->wherePivot('watched', true)->exists() ? 'display:block;' : 'display:none;' }}">
                        <button class="btn btn-success" onclick="markVideoDone({{ $video->id }})">
                            <i class="fas fa-check"></i> Mark as Done
                        </button>
                    </div>
                    @else
                    <!-- Locked Video -->
                    <div class="video-thumbnail locked text-center py-4">
                        <p><i class="fas fa-lock fa-3x"></i></p>
                        <p class="text-muted">Locked</p>
                    </div>
                    <h5 class="card-title text-center">{{ $video->title }}</h5>
                    <p class="text-danger text-center">Unlock this video by advancing to Level
                        {{ $video->level }}.
                    </p>
                    @endif
                </div>
            </div>
            @empty
            <div class="card">
                <div class="card-body">
                    <p class="text-center">No videos available for your current level.</p>
                </div>
            </div>
            @endforelse

            @endif

            @if($plan->subscription_type == 'personal_training')

            @foreach($plan->videos as $video)

            <h3>{{ $plan->name }}</h3>


            <div class="video-widget mb-4">
                <div class="video-thumbnail col-4">
                    <video id="video-{{ $video->id }}" class="rounded mb-2 w-100"
                        controls controlsList="nodownload"
                        data-video-id="{{ $video->id }}">
                        <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <div class="video-widget-body">
                    <h5 class="widget-title">{{ $video->title }}</h5>
                    <!-- <p class="widget-description">Level {{ $video->level }} unlocked</p> -->
                </div>
            </div>




            @endforeach

            @endif

        </div>



        @endforeach



        @if($unsub_plans)
        <div class="container my-5">
            <h2 class="text-left mb-5">Subscribe to more plans to view workouts</h2>

            <div class="d-flex justify-content-left">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($unsub_plans as $plan)
                    <!-- If a subscription exists with the plan id and the user id of the logged in user,do not show it or show already subscribed,go to workouts -->
                    <div class="col">
                        <div class="widget p-4 shadow-lg rounded text-center bg-light mb-4" style="height: 300px;">
                            <h4 class="text-primary mb-3">{{ $plan->name }}</h4>
                            <p class="text-muted mb-4">{{ $plan->description }}</p>
                            <h5 class="text-success mb-4">${{ $plan->price }} / month</h5>

                            <div class="d-grid gap-2" style="position: relative; bottom: 20px;">
                                <a href="{{ route('subscriptions.form', ['plan' => $plan->id]) }}"
                                    class="btn btn-lg btn-outline-primary">
                                    Subscribe
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif


    </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <!-- Level Upgrade Button -->
        <!-- <div class="text-center mt-4">
            <form action="{{ route('upgrade.level') }}" method="POST" class="mr-5">
                @csrf
                <button type="submit" class="btn btn-warning btn-lg">Upgrade Level</button>
            </form> -->
    </div>

    <!-- Track Your Progress Section -->
    <div class="mt-4 text-center">
        <!-- <a href="{{ route('track.progress') }}" class="btn btn-info btn-lg rounded-circle">Track Your Progress</a> -->
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

    .video-thumbnail.locked {
        background-color: #f8f9fa;
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
        color: #6c757d;
        font-weight: bold;
    }

    .video-thumbnail video {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 5px;
    }


    .card {
        background-color:
            border-radius: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 300px !important;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .btn-block {
        width: 100%;
        margin-top: 10px;
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function markVideoDone(videoId) {
        if (confirm('Are you sure you want to mark this video as done?')) {
            fetch('/mark-video-done', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        videoId: videoId
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const devotionalContent = document.getElementById('devotional-' + videoId);
                        const doneBtn = document.getElementById('done-btn-' + videoId);

                        if (devotionalContent) devotionalContent.style.display = 'block';
                        if (doneBtn) doneBtn.style.display = 'block';

                        alert('Video marked as done!');
                    } else {
                        alert('Error marking video as done!');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    document.querySelectorAll('video').forEach(video => {
        const videoId = video.getAttribute('data-video-id');
        const devotionalContent = document.getElementById('devotional-' + videoId);
        const doneBtn = document.getElementById('done-btn-' + videoId);

        video.addEventListener('timeupdate', function() {
            const progress = (video.currentTime / video.duration) * 100;
            updateProgress(videoId, progress);
        });

        video.addEventListener('ended', function() {
            if (devotionalContent) devotionalContent.style.display = 'block';
            if (doneBtn) doneBtn.style.display = 'block';
            markVideoDone(videoId); // Automatically mark as done
        });
    });
</script>
@endpush
@endsection