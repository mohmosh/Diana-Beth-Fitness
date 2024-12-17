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
            background: linear-gradient(135deg, #4c065e, #8e44ad);
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            background: #ffffff;
            color: #000000;
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
        }

        .btn-primary {
            background: #b717df;
            border: none;
            font-size: 1.2rem;
            padding: 1.5rem 2rem;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: #8e44ad;
            transform: scale(1.03);
        }

        .card-footer a {
            color: #b717df;
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
            color: #b717df;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body p-5">

                        {{-- Display Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Display Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Display Error Message --}}
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
{{--
                      registration form --}}
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Your Full Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Your Phone Number" value="{{ old('phone_number') }}" required>
                                    @error('phone_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Your Email Address" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="fitness_goal" class="form-label">Fitness Goal</label>
                                    <input type="text" class="form-control @error('fitness_goal') is-invalid @enderror" name="fitness_goal" id="fitness_goal" placeholder="Your Fitness Goals" value="{{ old('fitness_goal') }}">
                                    @error('fitness_goal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="preferences" class="form-label">Preferences</label>
                                    <input type="text" class="form-control @error('preferences') is-invalid @enderror" name="preferences" id="preferences" placeholder="Your Preferences" value="{{ old('preferences') }}">
                                    @error('preferences')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Create Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <input type="hidden" name="role_id" value="2">

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <small>Already have an account? <a href="{{ route('login') }}">Login here</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
