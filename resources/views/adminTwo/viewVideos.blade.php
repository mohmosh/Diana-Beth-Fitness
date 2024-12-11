@extends('adminTwo.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Uploaded Videos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Video</th>
                <th>Uploaded At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($videos as $video)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $video->title }}</td>
                    <td>
                        <video width="320" height="240" controls>
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </td>
                    <td>{{ $video->created_at->format('d M, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No videos uploaded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
