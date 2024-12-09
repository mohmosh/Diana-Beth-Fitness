@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>

    <a href="{{ route('admin.showUploadMedia') }}">Upload Media</a>
    <a href="{{ route('admin.pendingContent') }}">Manage Pending Content</a>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h2>Uploaded Media</h2>
    @if ($mediaFiles->isEmpty())
        <p>No media uploaded yet.</p>
    @else
        <ul>
            @foreach ($mediaFiles as $media)
                <li>
                    @if (str_contains($media->type, 'image'))
                        <img src="{{ asset('storage/' . $media->path) }}" alt="Media" width="150">
                    @elseif (str_contains($media->type, 'video'))
                        <video width="320" controls>
                            <source src="{{ asset('storage/' . $media->path) }}" type="{{ $media->type }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                    {{-- <p>Uploaded by: {{ $media->uploaded_by }}</p> --}}
                    <p>Uploaded on: {{ $media->created_at->format('Y-m-d H:i') }}</p>
                </li>
            @endforeach
        </ul>
    @endif
@endsection

