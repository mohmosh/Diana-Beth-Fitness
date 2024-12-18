<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Link to external CSS file (adjust path as needed) -->
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

</head>

<body>

    <header>
        <!--? Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">


                        {{-- logo --}}
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo" style="text-align: left;">
                                <a href="index.html">
                                    <img src="assets/img/logo/logo.png" alt="" style="width: 120px; height: auto; margin-left: 2px;">
                                </a>
                            </div>
                        </div>



                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="{{ route('user.videos.index') }}">Workouts</a></li>
                                            <li><a href="services.html">Program</a></li>
                                            <li><a href="schedule.html">Healthy Living</a></li>

                                            <li><a href="#gallery" onclick="scrollToGallery()">Gallery</a></li>
                                            <li><a href="#contact">Contact</a></li>

                                            <li><a href="contact.html">FitFam</a></li>

                                        </ul>
                                    </nav>
                                </div>

                                {{-- Register Button --}}
                                <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                    <a class="btn header-btn ms-2" href="{{ url('/register') }}">Register</a>
                                </div>

                                {{-- Login Button --}}
                                <div class="header-right-btn f-right d-none d-lg-block ml-15">
                                    <a class="btn header-btn ms-2" href="{{ url('/login') }}">Login</a>
                                </div>

                            </div>
                        </div>

                        {{-- // Logout  --}}
                        {{-- <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li> --}}
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

</body>

</html>
