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
<body>

     <!-- Header Start -->
     <div class="header-area header-transparent">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo" style="text-align: left;">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" style="width: 150px; height: 150px; margin-left: 2px;">
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
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Community
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('testimonials.index') }}">Testimonials</a></li>
                                                <li><a class="dropdown-item" href="{{ route('testimonials.index') }}">Forums</a></li>
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


    <main>
        <!--? Hero Start -->
        <div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 text-center pt-70">
                                <h2>About Us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!--? About Area Start -->
        <section class="mission-vision-area section-padding30">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <!-- Vision Image -->
                        <div class="mission-vision-img">
                            <img src="assets/img/gallery/dbflogo.png" alt="Vision Image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="mission-vision-caption">
                            <!-- Section Title -->
                            <div class="section-title section-title3 mb-35">
                                <span>OUR MISSION & VISION</span>
                                <h2>Get Fit for Purpose - Body, Mind, and Spirit</h2>
                            </div>

                            <!-- Vision Section -->
                            <h3 class="vision-heading">Our Vision</h3>
                            <p class="pera-top">To help individuals recognize the sacredness of their body and develop it as a vessel for God's purpose through fitness and spiritual growth.</p>

                            <!-- Mission Section -->
                            <h3 class="mission-heading">Our Mission</h3>
                            <p class="pera-bottom">We are dedicated to creating a community where individuals are inspired to achieve physical, mental, and spiritual well-being by integrating faith and fitness.</p>

                            <a class="btn header-btn ms-2" href="{{ url('/register') }}">JOIN NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About-2 Area End -->
        <!--? About-2 Area Start -->
        <section class="about-area2 testimonial-area section-padding30 fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-11 col-sm-11">
                        <!-- about-img -->
                        <div class="about-img2">
                            <img src="assets/img/gallery/12.jpg" alt="">
                            <!-- Shape -->
                            <div class="shape-qutaion d-none d-sm-block">
                                <img src="assets/img//gallery/qutaion.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-9">
                        <div class="about-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle mb-55">
                                <span>Client Feedback</span>
                                <h2>What Our Client say About Us</h2>
                            </div>
                            <!-- Testimonial Start -->
                            <div class="h1-testimonial-active">
                                <!-- Single Testimonial -->
                                <div class="single-testimonial">
                                    <div class="testimonial-caption">
                                        <p>I don't like jumping jacks, but this particular day they helped me expel a flu and helped a painful ankle heal.
                                            I was going with "healed!" "healed! with every jump until it was enjoyable and pain free" </p>
                                        <div class="rattiong-caption">
                                            <span>Buyanzi<span>Client</span> </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Testimonial -->
                                <div class="single-testimonial">
                                    <div class="testimonial-caption">
                                        <p>I don't like jumping jacks, but this particular day they helped me expel a flu and helped a painful ankle heal.
                                            I was going with "healed!" "healed! with every jump until it was enjoyable and pain free" </p>
                                        <div class="rattiong-caption">
                                            <span>Buyanzi<span>Client</span> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Testimonial End -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About-2 Area End -->


        <!--? Want To work -->
        <section class="wantToWork-area w-padding">
             <div class="team-area pb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-team mb-30">
                    <div class="team-img">
                        <img src="assets/img/gallery/11.jpg" alt="">
                        <div class="team-caption">
                            <span>CEO</span>
                            <h3><a href="#">Diana Beth</a></h3>
                            <!-- Blog Social -->
                            <div class="team-social">
                                <ul>

                                    <li><a href="https://www.instagram.com/diana_beth_fitness/?hl=en"><i class="fab fa-instagram"></i></a></li>

                                    <li><a href="https://web.facebook.com/search/top?q=diana%20beth%20fitness"><i class="fab fa-facebook-f"></i></a></li>

                                    <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-team mb-30">
                    <div class="team-img">
                        <img src="assets/img/gallery/9.jpg" alt="">
                        <div class="team-caption">
                            <span>Fitness Coach</span>
                            <h3><a href="#">Diana Beth</a></h3>
                            <!-- Blog Social -->
                            <div class="team-social">
                                <ul>
                                    <li><a href="https://www.instagram.com/diana_beth_fitness/?hl=en"><i class="fab fa-instagram"></i></a></li>

                                    <li><a href="https://web.facebook.com/search/top?q=diana%20beth%20fitness"><i class="fab fa-facebook-f"></i></a></li>

                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-team mb-30">
                    <div class="team-img">
                        <img src="assets/img/gallery/10.jpg" alt="">
                        <div class="team-caption">
                            <span>CEO</span>
                            <h3><a href="#">Diana Beth</a></h3>
                            <!-- Blog Social -->
                            <div class="team-social">
                                <ul>
                                    <li><a href="https://www.instagram.com/diana_beth_fitness/?hl=en"><i class="fab fa-instagram"></i></a></li>

                                    <li><a href="https://web.facebook.com/search/top?q=diana%20beth%20fitness"><i class="fab fa-facebook-f"></i></a></li>

                                    <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>lh
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </section>
        <!-- Want To work End -->


    </main>
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
                                        <p class="info1">Learn to love yourself from where you're at.Love your Body enough to want it to function better</p>
                                    </div>
                                </div>
                                <!-- Footer Social -->
                                <div class="footer-social ">
                                    <a href="https://www.instagram.com/diana_beth_fitness/?hl=en"><i class="fab fa-instagram"></i></a>

                                    <a href="https://web.facebook.com/search/top?q=diana%20beth%20fitness"><i class="fab fa-facebook-f"></i></a>

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
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">YadaInnovations</a>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->
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

    <!-- counter , waypoint, Hover Direction-->
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

    </body>
</html>
