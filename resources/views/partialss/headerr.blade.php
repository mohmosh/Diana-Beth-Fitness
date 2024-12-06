<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Health & Fitness | Template')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Link to external CSS file (adjust path as needed) -->
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
</head>
<body>
<header class="header-area">
    <div class="main-header header-sticky">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Logo Section -->
                <div class="col-xl-2 col-lg-2 col-md-1">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo"></a>
                    </div>
                </div>

                <!-- Menu Section -->
                <div class="col-xl-10 col-lg-10 col-md-10">
                    <div class="menu-main d-flex align-items-center justify-content-end">
                        <div class="main-menu">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('/about') }}">About</a></li>
                                    <li><a href="{{ url('/services') }}">Services</a></li>
                                    <li><a href="{{ url('/schedule') }}">Schedule</a></li>
                                    <li><a href="{{ url('/gallery') }}">Gallery</a></li>
                                    <li><a href="{{ url('/blog') }}">Blog
                                        <ul class="submenu">
                                            <li><a href="{{ url('/blog') }}">Blog</a></li>
                                            <li><a href="{{ url('/blog/details') }}">Blog Details</a></li>
                                            <li><a href="{{ url('/elements') }}">Element</a></li>
                                        </ul>
                                    </a></li>
                                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Membership Button -->
                        <div class="header-right-btn">
                            <a href="{{ url('/membership') }}" class="btn header-btn">Become a Member</a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu (For smaller devices) -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</header>
</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">  <!-- Custom CSS -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="#">DianaBethFitness</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Schedules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Gallery</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Blog Detail</a>
                        <a class="dropdown-item" href="#">Elements</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
