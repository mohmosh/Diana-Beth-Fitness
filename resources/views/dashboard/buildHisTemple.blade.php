@extends('user.dashboard')

@section('content')
<div class="container mt-4">

    <h1 class="display-4 mb-4 text-purple text-center">Build His Temple Dashboard</h1>

    <!-- Display Videos for Build His Temple -->
    <h5>Videos Available for Your Level</h5>
    <div class="row">
        @foreach($videos as $video)
            @if($video->subscription_type == 'build_his_temple' && auth()->user()->level >= $video->level)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <video width="320" height="240" class="rounded" controls>
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/ogg">
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
                            <p class="text-muted">Level {{ $video->level }} required</p>
                        </div>
                    </div>
                </div>
            @elseif($video->subscription_type == 'build_his_temple' && auth()->user()->level < $video->level)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <p class="text-muted">Unlock this video by advancing to Level {{ $video->level }}.</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Display Devotionals for Build His Temple -->
    <h5>Devotionals Available for Your Level</h5>
    <div class="row">
        @foreach($devotionals as $devotional)
            @if($devotional->plan == 'build_his_temple' && auth()->user()->level >= $devotional->level_required)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $devotional->title }}</h5>
                            <p class="card-text">{{ Str::limit($devotional->content, 50) }}</p>
                            <a href="#" class="btn btn-info">View</a>
                        </div>
                    </div>
                </div>
            @elseif($devotional->plan == 'build_his_temple' && auth()->user()->level < $devotional->level_required)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $devotional->title }}</h5>
                            <p class="card-text">{{ Str::limit($devotional->content, 50) }}</p>
                            <p class="text-muted">Unlock more devotionals by advancing your level.</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>
@endsection
