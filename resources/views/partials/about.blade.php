<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Workouts')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Include any CSS files here -->
</head>
<body>
    <!-- Workouts Area Start -->
    <section class="workouts-area section-padding30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <!-- workouts-img -->
                    <div class="workouts-img">
                        <img src="assets/img/gallery/dbflogo.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="workouts-caption">
                        <!-- Section Title -->
                        <div class="section-title section-title3 mb-35">
                            <span>ABOUT OUR WORKOUTS</span>
                            <h2>Safe Bodybuilding Solutions That Save Our Valuable Time!</h2>
                        </div>
                        <p class="pera-top">Brook presents your services with flexible, convenient and diverse layouts.
                            You can select your favorite layouts & elements for various tasks with unlimited customization
                            possibilities. Pixel-perfect replication of the designs is intended.</p>
                        <p class="mb-65 pera-bottom">Brook presents your services with flexible, convenient, and efficient
                            multipurpose layouts. You can select your favorite layouts.</p>
                        <a class="btn header-btn ms-2" href="{{ url('/register') }}">Become A Member</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Workouts Area End -->
</body>
</html>
