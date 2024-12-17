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
            /* Light background for improved readability */
            color: #333;
            /* Dark text for better contrast */
            font-family: 'Arial', sans-serif;
            /* Improved readability */
        }

        .header-area {
            background: linear-gradient(135deg, #8e44ad, #2c3e50);
            /* Subtle gradient for background */
            color: #ffffff;
        }

        .main-menu {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 1.5rem;
            /* More spacing between menu items */
            padding: 0.5rem 0;
            /* Adds some padding for better spacing */
        }

        .main-menu ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .main-menu li {
            margin: 0 0.5rem;
            position: relative;
            /* For dropdown positioning */
        }

        .main-menu a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .main-menu a:hover {
            color: #9b59b6;
            /* Subtle hover effect */
        }

        .logo img {
            width: 120px;
            /* Slightly larger logo for better visibility */
        }

        .btn-danger {
            background: #e74c3c;
            border: none;
            padding: 0.5rem 1.2rem;
            /* Larger padding for better clickability */
            color: white;
            border-radius: 5px;
            transition: background 0.3s ease;
            /* Smooth transition for hover effect */
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .dropdown-menu {
            display: none;
            /* Hidden by default */
            background: #34495e;
            /* Dark background for dropdown */
            border: none;
            position: absolute;
            /* Correct positioning for dropdown */
            top: 100%;
            left: 0;
            width: 200px;
            /* Fixed width for consistency */
        }

        .dropdown-menu.show {
            display: block;
            /* Show when activated */
        }

        .dropdown-item {
            color: #ffffff;
            padding: 0.5rem 1rem;
            transition: background 0.3s ease;
        }

        .dropdown-item:hover {
            background: #9b59b6;
            /* Hover effect for dropdown items */
        }
    </style>
</head>

<body>
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">

                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo" style="text-align: left;">
                                <a href="index.html">
                                    <img src="assets/img/logo/logo.png" alt="" style="width: 120px; height: auto; margin-left: 2px;">
                                </a>
                            </div>
                        </div>


                        <!-- Navigation Menu -->
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main Menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="{{ route('user.videos.index') }}">Workouts</a></li>

                                            <li><a href="services.html">Program</a></li>
                                            <li><a href="schedule.html">Healthy LIving</a></li>
                                            <li><a href="#gallery" onclick="scrollToGallery()">Gallery</a></li>

                                            <li><a href="#contact">Contact</a></li>


                                            <!-- Community Dropdown -->
                                            <li class="nav-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Fit Fam
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="communityDropdown">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('testimonials.access') }}">Testimonials</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('forums.access') }}">Forums</a>
                                                    </li>
                                                </ul>
                                            </li>




                                            {{-- <!-- Community Dropdown -->
                                            <li class="nav-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle"
                                                    id="communityDropdown" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Fit Fam
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="communityDropdown">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('testimonials.access') }}">Testimonials</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('forums.access') }}">Forums</a>
                                                    </li>
                                                </ul>
                                            </li> --}}



                                            @auth
                                                <!-- Logout Button -->
                                                <li class="nav-item">
                                                    <form action="{{ route('logout') }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Logout</button>
                                                    </form>
                                                </li>
                                            @endauth
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <!-- Custom Script -->
    <script>
        function toggleDropdown() {
            var dropdownMenu = document.querySelector('.dropdown-menu');
            var dropdownButton = document.getElementById('communityDropdown');
            if (dropdownButton.textContent.trim() === 'Fit Fam') {
                dropdownMenu.classList.toggle('show');
            }
        }
    </script>
</body>

</html>
