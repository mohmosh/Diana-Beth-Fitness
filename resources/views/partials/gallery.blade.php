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
    <div class="gallery-area" id="gallery">

        <div class="container-fluid p-0 fix">
            <div class="row">
                <div class="col-lg-6">
                    <div class="box snake mb-30">
                        <div class="gallery-img big-img" style="background-image: url(assets/img/gallery/13.jpg);"></div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <a href="gallery.html"><i class="ti-arrow-top-right"></i></a>
                                <h3>Best fitness gallery</h3>
                                <p>Fitness, Body</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="box snake mb-30">
                                <div class="gallery-img small-img" style="background-image: url(assets/img/gallery/2.jpg);"></div>
                                <div class="overlay">
                                    <div class="overlay-content">
                                        <a href="gallery.html"><i class="ti-arrow-top-right"></i></a>
                                        <h3>Best fitness gallery</h3>
                                        <p>Fitness, Body</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="box snake mb-30">
                                <div class="gallery-img small-img" style="background-image: url(assets/img/gallery/3.jpg);"></div>
                                <div class="overlay">
                                    <div class="overlay-content">
                                        <a href="gallery.html"><i class="ti-arrow-top-right"></i></a>
                                        <h3>Best fitness gallery</h3>
                                        <p>Fitness, Body</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="box snake mb-30">
                                <div class="gallery-img small-img" style="background-image: url(assets/img/gallery/4.jpg);"></div>
                                <div class="overlay">
                                    <div class="overlay-content">
                                        <a href="gallery.html"><i class="ti-arrow-top-right"></i></a>
                                        <h3>Best fitness gallery</h3>
                                        <p>Fitness, Body</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="box snake mb-30">
                                <div class="gallery-img small-img" style="background-image: url(assets/img/gallery/5.jpg);"></div>
                                <div class="overlay">
                                    <div class="overlay-content">
                                        <a href="gallery.html"><i class="ti-arrow-top-right"></i></a>
                                        <h3>Best fitness gallery</h3>
                                        <p>Fitness, Body</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Area End -->
</body>
</html>


<script>
    function scrollToGallery() {
        const element = document.getElementById('gallery');
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
