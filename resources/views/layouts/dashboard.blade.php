<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Diana Beth Fitness </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">


	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<nav class="navbar navbar-expand-lg">
    <div class="container d-flex align-items-center">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Free Trial Videos</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <div class="mx-auto">
                        <a class="nav-link text-white text-center"
                            href="{{ route('user.devotionals.index') }}">Devotionals</a>
                    </div>

                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
{{--
    <div class="alert alert-info text-center">
        @if ($daysLeft > 0)
            <strong>Free Trial:</strong> You have <strong>{{ round($daysLeft) }} day{{ round($daysLeft) > 1 ? 's' : '' }}</strong> left before your trial ends.
        @else
            <strong>Your free trial has ended.</strong> Please subscribe to either the <a href="{{ route('subscription.choose') }}">Build His Temple</a> or <a href="{{ route('subscription.choose') }}">Personal Training</a> plan.
        @endif
    </div> --}}

            <a href="javascript:history.back()" class="btn btn-secondary mb-4">Back</a>
        </div>


           <!-- Track Your Progress Section -->
        <div class="mt-4 text-center">
            <h5>Track Your Progress</h5>
            <!-- Button to toggle form visibility -->
            <button id="show-form-btn" class="btn btn-info rounded-circle" onclick="toggleProgressForm()">Track Your Progress</button>

            <!-- Form to Update Progress -->
            <div id="progress-form"
                style="display: none; margin-top: 20px; max-width: 500px; margin-left: auto; margin-right: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9;">

                @php
                    $progress = auth()->user()->progress()->orderBy('created_at', 'asc')->get();
                @endphp

                @if ($progress->isNotEmpty())
                    <h3>My Progress History</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Starting Weight</th>
                                <th>Closing Weight</th>
                                <th>Progress Date</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($progress as $entry)
                                <tr>
                                    <td>{{ $entry->starting_weight }}</td>
                                    <td>{{ $entry->closing_weight }}</td>
                                    <td>{{ $entry->progress_date }}</td>
                                    <td>{{ $entry->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No progress records found. Please add progress.</p>
                @endif

                @php
                    $latestProgress = auth()->user()->progress()->latest()->first();
                @endphp

                @if ($latestProgress)
                    <!-- Form to Update Progress -->
                    <form action="{{ route('progress.update', $latestProgress->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="start_weight">Starting Weight (kg):</label>
                            <input type="number" class="form-control" id="start_weight" name="start_weight"
                                value="{{ $latestProgress->starting_weight ?? '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="closing_weight">Closing Weight (kg):</label>
                            <input type="number" class="form-control" id="closing_weight" name="closing_weight"
                                value="{{ $latestProgress->closing_weight ?? '' }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Weight</button>
                    </form>
                @else
                    <!-- Message when no progress exists -->
                    <p>No progress record found. Please add progress first.</p>

                    <!-- Form to Add New Progress -->
                    <form action="{{ route('progress.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="starting_weight">Starting Weight (kg):</label>
                            <input type="number" class="form-control" id="starting_weight" name="starting_weight"
                                placeholder="Enter your start weight" required>
                        </div>

                        <div class="form-group">
                            <label for="closing_weight">Closing Weight (kg):</label>
                            <input type="number" class="form-control" id="closing_weight" name="closing_weight"
                                placeholder="Enter your closing weight">
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Add Progress</button>
                    </form>
                @endif
            </div>

    <!-- Video Section -->
    <div class="container mt-4">
        <h1 class="text-center mb-5">Free Trial Videos</h1>

        <div class="row">
            @forelse($videos as $video)
                <div class="col-lg-4 col-md-6 mb-4">
                    <!-- Video Widget -->
                    <div class="video-widget">
                        <video controls onended="showDoneButton(this)" data-video-id="{{ $video->id }}">
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                            {{ $video->title }} - Your browser does not support the video tag.
                        </video>

                        <div class="video-widget-body">
                            <h5 class="widget-title">{{ $video->title }}</h5>
                            <p class="widget-description">{{ Str::limit($video->description, 100) }}</p>
                        </div>

                        <div class="devotional content mt-3" id="devotional-{{ $video->id }}"
                            style="{{ auth()->user()->videos()->where('video_id', $video->id)->wherePivot('watched', true)->exists() ? 'display:block;' : 'display:none;' }}">
                            <h6 class="widget-title text-center">Devotional</h6>
                            @if (Str::endsWith($video->devotional_file, '.pdf'))
                                <a href="{{ asset('storage/' . $video->devotional_file) }}" target="_blank"
                                    class="btn btn-info">View Devotional (PDF)</a>
                            @elseif (Str::endsWith($video->devotional_file, '.docx'))
                                <a href="{{ asset('storage/' . $video->devotional_file) }}" target="_blank"
                                    class="btn btn-info">View Devotional (DOCX)</a>
                            @else
                                <p class="text-muted">No preview available for this devotional file.</p>
                            @endif
                        </div>

                        <!-- Done Button -->
                        <div class="text-center" id="done-btn-{{ $video->id }}"
                            style="{{ auth()->user()->videos()->where('video_id', $video->id)->wherePivot('watched', true)->exists() ? 'display:block;' : 'display:none;' }}">
                            <button class="btn btn-success"
                                onclick="markVideoDone({{ $video->id }})">Done</button>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-danger">No videos available for Free Trial.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo" style="text-align: left;">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo"
                                    style="width: 150px; height: 150px; margin-left: 2px;">
                            </a>
                        </div>
                    </div>

                    <!-- Navbar -->
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        <li><a href="{{ route('aboutUs.index') }}">About Us</a></li>
                                        <li><a href="{{ route('user.videos.index') }}">Workouts</a></li>
                                        <li><a href="{{ route('user.devotionals.index') }}">Devotionals</a></li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Community
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('testimonials.access') }}">Challenges</a></li>

                                                <li><a class="dropdown-item"
                                                        href="{{ route('testimonials.access') }}">Testimonials</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('forums.access') }}">Forums</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </nav>
                            </div>


                            <!-- Auth Buttons -->
                            @guest
                                <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                    <a class="btn header-btn ms-2" href="{{ url('/register') }}">Register</a>
                                </div>
                                <div class="header-right-btn f-right d-none d-lg-block ml-15">
                                    <a class="btn header-btn ms-2" href="{{ url('/login') }}">Login</a>
                                </div>
                            @else
                                <div class="header-right-btn f-right d-none d-lg-block ml-15">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn header-btn ms-2">Logout</button>
                                    </form>
                                </div>
                            @endguest
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>

<body>

    <footer>
        <!--? Footer Start-->


        <div class="footer-area section-bg" data-background="assets/img/gallery/14.jpg">
            <div class="container">
                <div class="footer-top footer-padding">
                    <!-- Footer Menu -->
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>DBF</h4>
                                    <ul>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="/contact">Contact Us</a></li>
                                        <li><a href="#"> Press & Blog</a></li>
                                        <li><a href="#"> Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Open hour</h4>
                                    <ul>
                                        <li><a href="#">Monday 11am-5pm</a></li>
                                        <li><a href="#"> Tuesday-Friday 11am-8pm</a></li>
                                        <li><a href="#"> Saturday 8am-2pm</a></li>
                                        <li><a href="#"> Sunday 10pm-12am</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <!-- logo -->
                                {{-- <div class="footer-logo">
                                    <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                </div> --}}
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p class="info1">Learn to love yourself from where you're at.Love your Body
                                            enough to want it to function better</p>
                                    </div>
                                </div>
                                <!-- Footer Social -->
                                <div class="footer-social ">
                                    <a href="https://www.instagram.com/diana_beth_fitness/?hl=en"><i
                                            class="fab fa-instagram"></i></a>

                                    <a href="https://web.facebook.com/search/top?q=diana%20beth%20fitness"><i
                                            class="fab fa-facebook-f"></i></a>

                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fas fa-globe"></i></a>
                                    {{-- <a href="https://www.instagram.com/diana_beth_fitness/?hl=en"><i class="fab fa-instagram"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-12">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made  <i
                                        aria-hidden="true"></i> by <a href="https://colorlib.com"
                                        target="_blank">YadaInnovations</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Date Picker -->
<script src="./assets/js/gijgo.min.js"></script>
<!-- Nice-select, sticky -->
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="./assets/js/jquery.counterup.min.js"></script>
<script src="./assets/js/waypoints.min.js"></script>
<script src="./assets/js/jquery.countdown.min.js"></script>
<script src="./assets/js/hover-direction-snake.min.js"></script>

<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
