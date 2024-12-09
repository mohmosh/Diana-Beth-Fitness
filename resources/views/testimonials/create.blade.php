@extends('layouts.app')

@section('title', 'Create Testimonial')

@section('content')
<div class="container">
    <h1>Create a Testimonial</h1>
    <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <input type="file" name="video" id="video" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
