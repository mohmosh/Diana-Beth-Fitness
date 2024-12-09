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
                            <div class="logo">
                                <a href="index.html"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo"></a>
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
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="services.html">Services</a></li>
                                            <li><a href="schedule.html">Schedule</a></li>
                                            <li><a href="gallery.html">Gallery</a></li>
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                            <!-- Community Dropdown -->
                                            <li class="nav-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Community
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="communityDropdown">
                                                    <li><a class="dropdown-item" href="{{ route('testimonials.index') }}">Testimonials</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('forum.index') }}">Forum</a></li> <!-- New Link -->

                                                    {{-- <li><a class="dropdown-item" href="{{ route('comments.index') }}">Comments</a></li> --}}
                                                </ul>
                                            </li>
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


