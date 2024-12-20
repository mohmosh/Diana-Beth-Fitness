<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: 'Arial', sans-serif;
            font-size: 1.125rem; /* Increased font size */
        }

        /* Header Styles */
        .header-area {
            background: linear-gradient(135deg, #770082, #bf0fc5);
            padding: 1.5rem 2.5rem; /* Increased padding */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Logo Styles */
        .logo img {
            width: 70px;
            height: auto;
        }

        /* Navigation Styles */
        .main-menu {
            display: flex;
            align-items: center;
            gap: 20px; /* Increased spacing between menu items */
        }

        .main-menu a {
            font-size: 1.7rem; /* Increased font size */
            padding: 0.5rem 1.25rem; /* Increased padding */
            color: #ffffff;
            /* text-transform: uppercase; */
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .main-menu a:hover {
            color: #dda0dd;
        }

        .dropdown-menu {
            background: #000000;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: #ffffff;
            padding: 12px 24px; /* Increased padding */
            font-size: 5.125rem; /* Increased font size */
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .dropdown-item:hover {
            background: #770082;
            color: #ffffff;
        }

        /* Authentication Buttons */
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 10px; /* Increased spacing between buttons */
        }

        .btn {
            padding: 3.75rem 3.5rem; /* Increased padding */
            font-size: 2.0rem; /* Increased font size */
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #008CBA;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #005f73;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background-color: #565e64;
        }

        .btn-danger {
            background-color: #800080;
            color: #ffffff;
            border: none;
        }

        .btn-danger:hover {
            background-color: #4b0082;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-area">
            <div class="container-fluid">
                <div class="header-container">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.html">
                            <img src="assets/img/logo/logo.png" alt="Logo">
                        </a>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="main-menu">
                        <a href="index.html">Home</a>
                        <a href="{{ route('user.videos.index') }}">Workouts</a>
                        <a href="services.html">Program</a>
                        <a href="schedule.html">Healthy Living</a>
                        <a href="#gallery" onclick="scrollToGallery()">Gallery</a>
                        <a href="#contact">Contact</a>

                        <!-- Dropdown Menu -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="communityDropdown" role="button" data-bs-toggle="dropdown">
                                Fit Fam
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('testimonials.access') }}">Testimonials</a></li>
                                <li><a class="dropdown-item" href="{{ route('forums.access') }}">Forums</a></li>
                            </ul>
                        </div>
                    </nav>

                    <!-- Authentication Buttons -->
                    <div class="auth-buttons">
                        @auth
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
        function scrollToGallery() {
            document.querySelector("#gallery").scrollIntoView({ behavior: "smooth" });
        }
    </script>
</body>

</html>
