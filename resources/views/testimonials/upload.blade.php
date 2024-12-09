@extends('layouts.app')

@section('title', 'Add a Testimonial')

@section('content')
    <div class="card p-4">
        <h1>Add Your Testimonial</h1>

        {{-- Display validation errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="content">Testimonial</label>
                <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Photo (optional)</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Upload Video (optional)</label>
                <input type="file" class="form-control" name="video" id="video" accept="video/*">
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

