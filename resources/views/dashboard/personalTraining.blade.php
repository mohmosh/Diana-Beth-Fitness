
<div class="container mt-4">
    <h1 class="text-center text-success mb-5">Personal Training Videos</h1>

    <div class="row">
        @forelse($videos as $video)
            <div class="col-lg-4 col-md-6 mb-4">
                <!-- Video Widget -->
                <div class="video-widget bg-white p-3 rounded shadow-sm overflow-hidden">
                    <video width="100%" controls class="rounded mb-3" alt="Video: {{ $video->title }}">
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

        .video-widget .video {
            border-radius: 15px;
        }
    </style>
@endpush
