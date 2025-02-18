@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Include Bootstrap CSS -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/animated-headline.css">
        <link rel="stylesheet" href="assets/css/style.css">

    </head>

    <body>
        <div class="container mt-6">

            <div class="row justify-content-center">
                <div class="col-md-8 d-flex align-items-center justify-content-center">
                    <div class="card-main shadow-lg">
                        <div class="card-header py-3">
                            <h3 class="text-center mb-2">Login</h3>
                        </div>
                        <div class="card-body p-5">
                            <form action="{{ url('login') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email Address" required>
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter Password" required>
                                </div>

                                <div class="mb-4 text-end">
                                    <a href="{{ route('password.request') }}"
                                        class="text-decoration-none text-primary">Forgot Password?</a>
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
            background: linear-gradient(135deg, #2c022e, #8e44ad);
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .container {
            margin-top: 140px;
            /* Adjust this value as needed */
        }

        .card-main {
            border: none;
            border-radius: 15px;
            background: #ffffff;
            color: #000000;
            margin-top: 180px;
            font-size: 20px;
        }

        .card-header {
            background: #b717df;
            color: #ffffff;
        }

        .card-header {
            background: #b717df;
            color: #ffffff;
            text-align: center;
            font-size: 60px;
        }

        .form-control {
            border-radius: 10px;
            font-size: 15px;
            padding: 6.5%;
        }

        .btn-primary {
            background: #b717df;
            border: none;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: #8e44ad !important;
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
            font-size: 20px;
            font-weight: bold;
            color: black;
        }


        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) and (max-width: 767px) {
            .card-main {
                height: 600px;
                width: 800px;
                padding: 15%;
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
           @media (min-width: 992px) and (max-width:1199px) {
            .card-main {
                height: 600px;
                width: 1000px;
                padding: 7%;
                margin-top: 120px;
                font-size: 17px;

            }

            

        }

           /* // Large devices (desktops, more than 992 and higher) */
           @media (min-width: 1200px) {
                .card-main {
                height: 700px;
                width: 1000px;
                padding: 10%;
                margin-top: 90px;
                font-size: 20px;

            }


        }
    </style>

@endsection
