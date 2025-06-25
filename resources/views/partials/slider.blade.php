<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include Bootstrap 4/5 or Tailwind if not already present -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/your-slider-library.css') }}"> {{-- If using Swiper or Owl --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> {{-- Your custom styles --}}
    <style>
        .slider-area {
            position: relative;
            overflow: hidden;
        }

        .slider-height {
            height: 100vh;
            background-size: cover;
            background-position: center;
        }

        .hero__caption {
            color: white;
            padding-top: 80px;
            animation: fadeInUp 1s ease-in-out;
        }

        .hero__caption h1 {
            font-size: 48px;
            font-weight: 700;
        }

        .hero-btn {
            background-color: #ff3e6c;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            margin-top: 20px;
            display: inline-block;
            transition: 0.3s ease-in-out;
        }

        .hero-btn:hover {
            background-color: #e9345e;
        }

        .video-icon {
            position: absolute;
            right: 30px;
            bottom: 30px;
        }

        .video-icon .btn-icon {
            font-size: 24px;
            background: white;
            color: #ff3e6c;
            border-radius: 50%;
            padding: 12px 16px;
            transition: all 0.3s;
        }

        .video-icon .btn-icon:hover {
            background: #ff3e6c;
            color: white;
        }

        @media (max-width: 768px) {
            .hero__caption h1 {
                font-size: 32px;
            }

            .hero__caption span {
                font-size: 16px;
            }

            .hero-btn {
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <main>
        <!-- Slider Area Start -->
        <div class="slider-area">
            <div class="slider-active">
                <!-- Slide 1 -->
                <div class="single-slider slider-height d-flex align-items-center" style="background-image: url('{{ asset('assets/img/slider1.jpg') }}');">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="hero__caption">
                                    <span>Welcome To</span>
                                    <h1>DIANA BETH FITNESS</h1>
                                    <a href="{{ url('/register') }}" class="btn hero-btn">Join Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="single-slider slider-height d-flex align-items-center" style="background-image: url('{{ asset('assets/img/slider2.jpg') }}');">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="hero__caption">
                                    <span>Welcome To</span>
                                    <h1>DIANA BETH FITNESS</h1>
                                    <a href="{{ url('/register') }}" class="btn hero-btn">Join Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video icon -->
            <div class="video-icon">
                <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=w3MyigEwok8">
                    <i class="fas fa-play"></i>
                </a>
            </div>
        </div>
        <!-- Slider Area End -->
    </main>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/your-slider-library.js') }}"></script> {{-- e.g., Swiper, OwlCarousel --}}
    <script>
        // Initialize slider if using Swiper/Owl
    </script>
</body>

</html>
