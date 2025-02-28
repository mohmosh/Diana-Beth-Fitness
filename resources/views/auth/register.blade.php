@extends('layouts.app')

@section('title', 'Register')

@section('content')


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register</title>

        <!-- Include Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


        <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/animated-headline.css">
        <link rel="stylesheet" href="assets/css/style.css">


    </head>

    <body>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8 d-flex align-items-center justify-content-center">
                    <div class="card-main shadow-lg">
                        <div class="card-header py-3">
                            <h3>Register</h3>
                        </div>
                        <div class="card-body p-5">
                            <!-- Display Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Registration Form -->
                            <form action="{{ route('register') }}" method="POST">
                                @csrf

                                <!-- Name and Phone Number -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Your Full Name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" id="phone_number" placeholder="Your Phone Number"
                                            value="{{ old('phone_number') }}" required>
                                        @error('phone_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="Your Email Address"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Fitness Goal and Preferences -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="fitness_goal" class="form-label">Fitness Goal</label>
                                        <input type="text"
                                            class="form-control @error('fitness_goal') is-invalid @enderror"
                                            name="fitness_goal" id="fitness_goal" placeholder="Your Fitness Goals"
                                            value="{{ old('fitness_goal') }}">
                                        @error('fitness_goal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="preferences" class="form-label">Preferences</label>
                                        <input type="text"
                                            class="form-control @error('preferences') is-invalid @enderror"
                                            name="preferences" id="preferences" placeholder="Your Preferences"
                                            value="{{ old('preferences') }}">
                                        @error('preferences')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Hidden Role ID (always set to 2 for User) -->
                                <input type="hidden" name="role_id" value="2">

                                <!-- Password and Confirmation -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="Create Password" required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>

                                <!-- Submit Button -->
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



        <!-- JS here -->

        <!-- Jquery, Popper, Bootstrap -->
        <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/jquery.slicknav.min.js"></script>
        <script src="./assets/js/main.js"></script>

    </body>

    </html>

    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(135deg, #4c065e, #8e44ad);
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .card-main {
            border: none;
            border-radius: 15px;
            background: #ffffff;
            color: #000000;
            margin-top: 180px;
            font-size: 15px;
        }

        .card-header {
            background: #b717df;
            color: #ffffff;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
            padding: 6.5%;
            font-size: 15px;
        }

        .btn-primary {
            background: #b717df;
            border: none;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: #8e44ad;
            transform: scale(1.03);
        }

        .card-footer a {
            color: #b717df;
            text-decoration: none;
        }

        .card-footer a:hover {
            color: #8e44ad;
            text-decoration: underline;
        }





        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) and (max-width: 767px) {
            .card-main {
                height: 790px;
                width: 800px;
                padding: 10%;
            }
        }

        /* // Small devices (landscape phones, less than 768px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .card-main {
                height: 550px;
                width: 1000px;
                padding: 10%;
            }

        }

       /* // Large devices (desktops, more than 992 and higher) */
       @media (min-width: 992px) and (max-width: 1199px) {
            .card-main {
                height: 600px;
                width: 1000px;
                padding: 7%;
                margin-top: 230px;
                font-size: 17px;
            }
        }

        /* // Large devices (desktops, more than 992 and higher) */
            @media (min-width: 1200px) {
                .card-main {
                height: 700px;
                width: 1000px;
                padding: 10%;
                margin-top: 200px;
                font-size: 20px;

            }


        }
    </style>


@endsection
