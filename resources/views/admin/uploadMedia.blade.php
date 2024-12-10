{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Upload Media')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #9b59b6;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #6c757d;
        }

        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }

        .form-control {
            border-color: #6c757d;
        }

        .form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 8px rgba(108, 117, 125, 0.25);
        }

        .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-primary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-primary:focus {
            box-shadow: 0 0 8px rgba(108, 117, 125, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        
        <h1 class="text-center mb-4">Upload Media</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.uploadMedia') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="media" class="form-label">Choose a file:</label>
                <input type="file" id="media" name="media" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


{{-- @endsection --}}



