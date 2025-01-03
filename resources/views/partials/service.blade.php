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
  <!--? Services Area Start -->
  <section class="services-area pt-100 pb-150 section-bg" data-background="assets/img/gallery/2.jpg">
    <!--? Want To work -->
    <section class="wantToWork-area w-padding">
        <div class="container">
            <div class="row align-items-end justify-content-between">
                <div class="col-lg-6 col-md-10 col-sm-10">
                    <div class="section-tittle section-tittle2">
                        <span>OUR PLANS</span>
                        <h2>THE SELFLESS NATURE OF EXERCISING</h2>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3">
                    <a href="subscriptions/choose" class="btn wantToWork-btn f-right">Our Services</a>
                </div>
            </div>

        </div>

    </section>
    <!-- Want To work End -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-4">
                <div class="single-cat text-center mb-50">
                    <div class="cat-icon">
                        <i class="flaticon-fitness"></i>
                    </div>
                    <div class="cat-cap">
                        <h5><a href="#plans">Personal Training</a></h5>
                        <p>A one on one training virtually.</p>
                    </div>
                    <div class="img-cap">
                        <a href="subscriptions/choose" class="">PERSONAL TRAINING <i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-4">
                <div class="single-cat text-center mb-50">
                    <div class="cat-icon">
                        <i class="flaticon-healthcare-and-medical"></i>
                    </div>
                    <div class="cat-cap">
                        <h5><a href="#plans">Build His Temple</a></h5>
                        <p>Get fit for a purpose .</p>
                    </div>
                    <div class="img-cap">
                        <a href="/subscriptions/choose" class="">BUILD HIS TEMPLE <i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>



        </div>
    </div>
</section>

<!-- Services Area End -->
</body>
</html>
