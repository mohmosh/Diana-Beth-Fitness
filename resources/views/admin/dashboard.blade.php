{{-- @extends('layouts.app')

@section('title', 'Login')

@section('content') --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>@yield('title', 'Admin Dashboard')</title> -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f9f9f9;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #b717df;
            color: #fff;
        }

        .btn {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #b717df;
            border-color: #b717df;
        }

        .btn-primary:hover {
            background-color: #5b0863;
            border-color: #710c85;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
        }

        .media-item img,
        .media-item video {
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .media-item p {
            font-size: 0.9rem;
        }

        .card-footer {
            background-color: #f1f1f1;
            color: #333;
        }

        .card-footer a {
            color: #b717df;
            text-decoration: none;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>


<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Admin Dashboard</h3>
                    </div>
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-center mb-4">
                            <a href="{{ route('admin.uploadVideo') }}" class="btn btn-primary mx-2 px-4 py-2">Upload Video</a>
                            <a href="{{ route('admin.pendingContent') }}" class="btn btn-secondary mx-2 px-4 py-2">Manage Pending Content</a>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success text-center mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h2 class="text-center mt-4 mb-3">Uploaded Media</h2>
                        @if ($mediaFiles->isEmpty())
                            <p class="text-center lead">No media uploaded yet.</p>
                        @else
                            <div class="row">
                                @foreach ($mediaFiles as $media)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 media-item">
                                            <div class="card-body">
                                                @if (str_contains($media->type, 'image'))
                                                    <img src="{{ asset('storage/' . $media->path) }}" alt="Media" class="img-fluid mb-2">
                                                @elseif (str_contains($media->type, 'video'))
                                                    <video controls class="w-100">
                                                        <source src="{{ asset('storage/' . $media->path) }}" type="{{ $media->type }}">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endif
                                                <p class="text-muted">Uploaded on: {{ $media->created_at->format('Y-m-d H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
{{--
@endsection --}}



