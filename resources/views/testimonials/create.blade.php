@extends('layouts.app')

@section('content')
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center pt-70">
                            <h2>Testimonials</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="container mt-4">
            <h1>Create a Testimonial</h1>
            <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="4"></textarea>
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
                <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-2 w-100">Cancel</a>
            </form>
        </div>
    </main>

@push('styles')
<style>
    body {
        background-color: #115294;
    }

    h1 {
        text-align: center;
        color: #343a40;
    }
    .btn-primary {
        width: 100%;
    }
</style>
@endpush

@push('scripts')

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <!-- Initialize CKEditor -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            ClassicEditor
                .create(document.querySelector('#content')) // Corrected ID
                .catch(error => console.error(error));
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endpush
