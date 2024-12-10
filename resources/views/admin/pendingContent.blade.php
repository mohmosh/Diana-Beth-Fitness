{{-- @extends('layouts.app') --}}

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Pending User Content</h1>

    @if ($pendingContent->isEmpty())
        <p class="text-center">No pending content to display.</p>
    @else
        @foreach ($pendingContent as $content)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">{{ $content->title }}</h3>
                    <p class="card-text">{{ $content->description }}</p>

                    @if ($content->media_path)
                        <p class="card-text">Media: <a href="{{ asset('storage/' . $content->media_path) }}" target="_blank" class="text-primary">View File</a></p>
                    @endif

                    <form action="{{ route('admin.approveContent', $content->id) }}" method="POST" class="d-inline-block mx-2">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                    </form>

                    <form action="{{ route('admin.rejectContent', $content->id) }}" method="POST" class="d-inline-block mx-2">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
{{-- @endsection --}}
