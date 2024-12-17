@extends('adminTwo.dashboard')

<main>
@section('content')
<div class="container mt-4">
    <!-- Page Title -->
    <div class="text-center">
        <h1 class="display-4 mb-4 text-purple">Uploaded Videos</h1>
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
            <table class="table table-striped table-hover table-bordered border-purple align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Video Preview</th>
                        {{-- <th>Thumbnail</th> --}}
                        <th>Uploaded At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($videos as $index => $video)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $video->title }}</td>
                            <td>
                                <video width="320" height="240" class="rounded" controls>
                                    <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </td>
                            {{-- <td>
                                {{-- @if($video->hasMedia('thumbnails'))
                                    <img src="{{ $video->getFirstMediaUrl('thumbnails', 'thumb') }}" width="100" height="75" class="rounded">
                                @else
                                    <img src="{{ asset('images/default-thumbnail.jpg') }}" width="100" height="75" class="rounded">
                                @endif --}}
                            </td> 
                            <td>{{ $video->created_at->format('d M, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-folder-x fs-4"></i>
                                <p class="mt-2">No videos uploaded yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
</main>
