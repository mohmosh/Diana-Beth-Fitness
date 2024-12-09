@extends('layouts.app')

@section('content')
    <h1>Pending User Content</h1>

    @if ($pendingContent->isEmpty())
        <p>No pending content to display.</p>
    @else
        @foreach ($pendingContent as $content)
            <div>
                <h3>{{ $content->title }}</h3>
                <p>{{ $content->description }}</p>

                @if ($content->media_path)
                    <p>Media: <a href="{{ asset('storage/' . $content->media_path) }}" target="_blank">View File</a></p>
                @endif

                <form action="{{ route('admin.approveContent', $content->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Approve</button>
                </form>

                <form action="{{ route('admin.rejectContent', $content->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Reject</button>
                </form>
            </div>
            <hr>
        @endforeach
    @endif
@endsection
