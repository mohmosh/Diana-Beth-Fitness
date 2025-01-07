@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Post Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                class="form-control @error('title') is-invalid @enderror" 
                value="{{ old('title') }}" 
                required
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea 
                id="content" 
                name="content" 
                rows="5" 
                class="form-control @error('content') is-invalid @enderror" 
                required
            >{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
