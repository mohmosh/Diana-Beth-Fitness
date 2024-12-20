<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Include any CSS files here -->
</head>

<body>
    <main>
        <!--? slider Area Start-->
        <div class="slider-area position-relative">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                                <div class="hero__caption">
                                    <span data-animation="fadeInLeft" data-delay="0.1s">Welcome To</span>
                                    <h1 data-animation="fadeInLeft" data-delay="0.4s">DIANA BETH FITNESS</h1>
                                    <a class="btn hero-btn " data-animation="fadeInLeft" data-delay="0.8s"
                                        href="{{ url('/register') }}">Join Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                                <div class="hero__caption">
                                    <span data-animation="fadeInLeft" data-delay="0.1s">Welcome To</span>
                                            <h1 data-animation="fadeInLeft" data-delay="0.4s">DIANA BETH FITNESS</h1>
                                            <a class="btn hero-btn " data-animation="fadeInLeft" data-delay="0.8s"
                                                href="{{ url('/register') }}">Join Now</a>

                                            {{-- <a href="from.html" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.8s">became a member</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Video icon -->
            <div class="video-icon">
                <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=w3MyigEwok8"><i
                        class="fas fa-play"></i></a>
            </div>
        </div>
        <!-- slider Area End-->
    </main>
</body>

</html>
