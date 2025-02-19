@extends('layouts.app')

@section('content')

<div class="slider-area2">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center pt-70">
                        <h2>FitFam Community</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<main>
    <div class="container mt-5">
        <h1>Create a New Post</h1>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" id="title" name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="content">Post Content</label>
                <textarea id="content" name="content" rows="5"
                    class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3 w-100">Create Post</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-2 w-100">Cancel</a>
        </form>
    </div>
</main>

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }


    h1 {
        text-align: center;
        color: #343a40;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@endsection
