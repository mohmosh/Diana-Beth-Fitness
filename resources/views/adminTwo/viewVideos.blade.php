@extends('adminTwo.dashboard')

<main>
@section('content')
<div class="container mt-4">
    <!-- Page Title -->
    <div class="text-center">
        <h1 class="display-4 mb-4 text-purple">Videos</h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Video Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-purple text-white">
            <h5 class="mb-0">Video Library</h5>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered border-purple align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Video Preview</th>
                            <th>Subscription Type</th>
                            <th>Level (For Build His Temple)</th>
                            <th>Uploaded At</th>
                            <th>Actions</th> <!-- New Column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $index => $video)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $video->title }}</td>
                                <td>
                                    @if(Storage::exists('public/' . $video->path))
                                            <video width="320" height="240" class="rounded" controls controlsList="nodownload" oncontextmenu="return false;">
                                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                            <source src="{{ asset('storage/' . $video->path) }}" type="video/ogg">
                                            <source src="{{ asset('storage/' . $video->path) }}" type="video/webm">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <p class="text-danger">Video not found</p>
                                    @endif
                                </td>
                                <td>
                                    @if($video->subscription_type == 'personal_training')
                                        Personal Training
                                    @elseif($video->subscription_type == 'build_his_temple')
                                        Build His Temple
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($video->subscription_type == 'build_his_temple')
                                        Level {{ $video->level }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $video->created_at->format('d M, Y') }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.editVideo', $video->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.deleteVideo', $video->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-folder-x fs-4"></i>
                                    <p class="mt-2">No videos uploaded yet.</p>
                                    <a href="{{ route('admin.uploadVideo') }}" class="btn btn-primary mt-3">Upload Your First Video</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
</main>
