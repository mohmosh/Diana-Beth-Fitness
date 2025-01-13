
<div class="container mt-4">
    <h1 class="display-4 mb-4 text-purple text-center" style="margin-top: -20px;">Build His Temple Dashboard</h1>

    <!-- Display User's Current Level and Progress -->
    <div class="text-center mb-4">
        <h5>Your Current Level: <strong>{{ auth()->user()->level }}</strong></h5>
        <p class="text-muted">Advance to the next level to unlock more content.</p>

        <!-- Progress Bar -->
        {{-- <div class="progress" style="height: 25px;">
            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <p class="mt-2">Progress: {{ $progress }}%</p>
    </div> --}}

    <!-- Display Videos for Build His Temple -->
    <h5 class="mb-3">Videos Available for Your Level</h5>
    <div class="row">
        @foreach($videos as $video)
            <div class="col-md-4 mb-4">
                <div class="video-widget bg-white p-3 rounded shadow-sm overflow-hidden">
                    <div class="video-thumbnail" style="position: relative; width: 100%; height: 180px; background-color: #f0f0f0; border-radius: 8px; overflow: hidden;">
                        <video width="100%" height="100%" class="rounded mb-3" controls>
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/ogg">
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                        <p class="text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 1.2rem; font-weight: bold; color: #fff;">
                            {{ $video->title }}
                        </p>
                    </div>

                    <!-- Level Requirement Text -->
                    <div class="mt-2 text-center">
                        @if(auth()->user()->level >= $video->level)
                            <!-- Video Available to User -->
                            <p class="text-muted">Level {{ $video->level }} unlocked</p>
                        @else
                            <!-- Video Locked for User -->
                            <p class="text-muted text-danger">Unlock this video by advancing to Level {{ $video->level }}.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <!-- Button to upgrade level -->
    @if(auth()->user()->level < 3) <!-- Ensure users can't advance past the maximum level -->
    <div class="text-center mt-4">
        <form action="{{ route('upgrade.level') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Advance to Next Level</button>
        </form>
    </div>
@endif
</div>
