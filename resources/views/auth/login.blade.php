{{-- @extends('layouts.app')

@section('title', 'Login')

@section('content') --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(135deg, #2c022e, #8e44ad);
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            background: #ffffff;
            color: #000000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            min-height: 300px; /* Adjust height as needed */
        }

        .card-header {
            background: #b717df;
            color: #ffffff;
        }

        .card-header h3 {
            font-weight: bold;
        }

        .form-control {
            border-radius: 10px;
            font-size: 1.1rem;
            padding: 1rem;
        }

        .btn-primary {
            background: #b717df
            border: none;
            font-size: 1.2rem;
            padding: 0.8rem 1.5rem;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: #8e44ad;
            transform: scale(1.03);
        }

        .card-footer a {
            color: #b717df
            text-decoration: none;
            font-weight: bold;
        }

        .card-footer a:hover {
            text-decoration: underline;
            color: #8e44ad;
        }

        .form-label {
            font-size: 1.1rem;
            font-weight: bold;
            color: #b717df
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="card shadow-lg">
                    <div class="card-header">
                        {{-- <h3 class="text-center mb-0">Login</h3> --}}
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ url('login') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email Address" required>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <small>Don't have an account? <a href="{{ route('register') }}">Register here</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

{{-- @endsection --}}




























