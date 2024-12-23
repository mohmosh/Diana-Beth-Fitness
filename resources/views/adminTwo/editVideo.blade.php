@extends('adminTwo.dashboard')

<main>
@section('content')
<div class="container mt-4">
    <h1>Edit Video</h1>
    <form action="{{ route('admin.updateVideo', $video->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $video->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $video->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">Video URL</label>
            <input type="url" name="url" class="form-control" value="{{ old('url', $video->url) }}">
        </div>

        <div class="mb-3">
            <label for="subscription_type" class="form-label">Subscription Type</label>
            <select name="subscription_type" class="form-select" required>
                <option value="personal_training" {{ $video->subscription_type == 'personal_training' ? 'selected' : '' }}>Personal Training</option>
                <option value="build_his_temple" {{ $video->subscription_type == 'build_his_temple' ? 'selected' : '' }}>Build His Temple</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Level (For Build His Temple)</label>
            <input type="number" name="level" class="form-control" value="{{ old('level', $video->level) }}" min="1">
        </div>

        <button type="submit" class="btn btn-primary">Update Video</button>
    </form>
</div>
@endsection
</main>
